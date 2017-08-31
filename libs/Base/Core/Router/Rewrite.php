<?php

namespace Base\Core\Router;

use Base\Core\Request\RequestAbstract;
use Base\Core\Request\Http as HttpRequest;
use Base\Core\Router\Route\Chain;
use Base\Core\Router\Route\Module as ModuleRoute;
use Base\Core\Router\Route\RouteInterface;

/**
 * Ruby routing based Router.
 */
class Rewrite extends RouterAbstract
{

    /**
     * Whether or not to use default routes
     *
     * @var boolean
     */
    protected $useDefaultRoutes = true;

    /**
     * Array of routes to match against
     *
     * @var array
     */
    protected $routes = [];

    /**
     * Currently matched route
     *
     * @var RouterInterface
     */
    protected $currentRoute = null;

    /**
     * Add default routes which are used to mimic basic router behaviour
     *
     * @return Rewrite
     */
    public function addDefaultRoutes()
    {
        if (!$this->hasRoute('default')) {
            $dispatcher = $this->getFrontController()->getDispatcher();
            $request = $this->getFrontController()->getRequest();

            $compat = new ModuleRoute([], $dispatcher, $request);

            $this->routes = array('default' => $compat) + $this->routes;
        }

        return $this;
    }

    /**
     * Add route to the route chain
     *
     * If route contains method setRequest(), it is initialized with a request object
     *
     * @param  string                                 $name       Name of the route
     * @param  RouteInterface $route      Instance of the route
     * @return Rewrite
     */
    public function addRoute($name, RouteInterface $route)
    {
        if (method_exists($route, 'setRequest')) {
            $route->setRequest($this->getFrontController()->getRequest());
        }

        $this->routes[$name] = $route;

        return $this;
    }

    /**
     * Add routes to the route chain
     *
     * @param  array $routes Array of routes with names as keys and routes as values
     * @return Rewrite
     */
    public function addRoutes($routes) {
        foreach ($routes as $name => $route) {
            $this->addRoute($name, $route);
        }

        return $this;
    }

    /**
     * Remove a route from the route chain
     *
     * @param  string $name Name of the route
     * @throws Exception
     * @return Rewrite
     */
    public function removeRoute($name)
    {
        if (!isset($this->routes[$name])) {
            throw new Exception("Route $name is not defined");
        }
        unset($this->routes[$name]);
        return $this;
    }

    /**
     * Remove all standard default routes
     *
     * @return Rewrite
     */
    public function removeDefaultRoutes()
    {
        $this->useDefaultRoutes = false;
        return $this;
    }

    /**
     * Check if named route exists
     *
     * @param  string $name Name of the route
     * @return boolean
     */
    public function hasRoute($name)
    {
        return isset($this->routes[$name]);
    }

    /**
     * Retrieve a named route
     *
     * @param string $name Name of the route
     * @throws Exception
     * @return RouteInterface Route object
     */
    public function getRoute($name)
    {
        if (!isset($this->routes[$name])) {
            throw new Exception("Route $name is not defined");
        }

        return $this->routes[$name];
    }

    /**
     * Retrieve a currently matched route
     *
     * @throws Exception
     * @return RouteInterface Route object
     */
    public function getCurrentRoute()
    {
        return $this->getRoute($this->getCurrentRouteName());
    }

    /**
     * Retrieve a name of currently matched route
     *
     * @throws Exception
     * @return RouteInterface Route object
     */
    public function getCurrentRouteName()
    {
        if (!isset($this->currentRoute)) {
            throw new Exception("Current route is not defined");
        }
        return $this->currentRoute;
    }

    /**
     * Retrieve an array of routes added to the route chain
     *
     * @return array All of the defined routes
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Find a matching route to the current PATH_INFO and inject
     * returning values to the Request object.
     *
     * @param RequestAbstract $request
     * @throws Exception
     * @return RequestAbstract Request object
     */
    public function route(RequestAbstract $request)
    {
        if (!$request instanceof HttpRequest) {
            throw new Exception('RouterRewrite requires a HttpRequest-based request object');
        }

        if ($this->useDefaultRoutes) {
            $this->addDefaultRoutes();
        }

        // Find the matching route
        $routeMatched = false;

        foreach (array_reverse($this->routes, true) as $name => $route) {
            if ($route instanceof Chain) {
                $match = clone $request;
            } else {
                $match = $request->getPathInfo();
            }

            if ($params = $route->match($match)) {
                $this->setRequestParams($request, $params);
                $this->currentRoute = $name;
                $routeMatched        = true;
                break;
            }
        }

         if (!$routeMatched) {
             throw new Exception('No route matched the request', 404);
         }

        return $request;

    }

    /**
     * Set routed parameters to request object
     *
     * @param RequestAbstract $request
     * @param array $params
     */
    protected function setRequestParams(RequestAbstract $request, array $params)
    {
        foreach ($params as $param => $value) {

            $request->setParam($param, $value);

            if ($param === $request->getModuleKey()) {
                $request->setModuleName($value);
            }
            if ($param === $request->getControllerKey()) {
                $request->setControllerName($value);
            }
            if ($param === $request->getActionKey()) {
                $request->setActionName($value);
            }

        }
    }
}
