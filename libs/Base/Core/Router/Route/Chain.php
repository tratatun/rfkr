<?php

namespace Base\Core\Router\Route;

use Base\Core\Request\RequestAbstract;
use Base\Core\Router\Route\RouteAbstract;

/**
 * Chain route is used for managing route chaining.
 *
 */
class Chain extends RouteAbstract
{
    protected $routes = [];
    protected $separators = [];

    /**
     * Add a route to this chain
     *
     * @param  RouteAbstract $route
     * @param  string                                $separator
     * @return Chain
     */
    public function chain(RouteAbstract $route, $separator = self::URI_DELIMITER)
    {
        $this->routes[]     = $route;
        $this->separators[] = $separator;

        return $this;

    }

    /**
     * Matches a user submitted path with a previously defined route.
     * Assigns and returns an array of defaults on a successful match.
     *
     * @param  RequestAbstract $request Request to get the path info from
     * @param  null                         $partial
     * @return array|false An array of assigned values or a false on a mismatch
     */
    public function match($request, $partial = null)
    {
        $path        = trim($request->getPathInfo(), self::URI_DELIMITER);
        $subPath     = $path;
        $values      = [];
        $numRoutes   = count($this->routes);
        $matchedPath = null;

        foreach ($this->routes as $key => $route) {
            if ($key > 0 && $matchedPath !== null && $subPath !== '' && $subPath !== false) {
                $separator = substr($subPath, 0, strlen($this->separators[$key]));

                if ($separator !== $this->separators[$key]) {
                    return false;
                }

                $subPath = substr($subPath, strlen($separator));
            }


            $request->setPathInfo($subPath);
            if ($route instanceof Chain) {
                $match = $request;
            } else {
                $match = $request->getPathInfo();
            }

            $res = $route->match($match, true, ($key == $numRoutes - 1));
            if ($res === false) {
                return false;
            }

            $matchedPath = $route->getMatchedPath();

            if ($matchedPath !== null) {
                $subPath     = substr($subPath, strlen($matchedPath));
                $separator   = substr($subPath, 0, strlen($this->separators[$key]));
            }

            $values = $res + $values;
        }

        $request->setPathInfo($path);

        if ($subPath !== '' && $subPath !== false) {
            return false;
        }

        return $values;
    }

    /**
     * Set the request object for this and the child routes
     *
     * @param  RequestAbstract|null $request
     * @return void
     */
    public function setRequest(RequestAbstract $request = null)
    {
        $this->request = $request;

        foreach ($this->routes as $route) {
            if (method_exists($route, 'setRequest')) {
                $route->setRequest($request);
            }
        }
    }

    /**
     * Return a single parameter of route's defaults
     *
     * @param  string $name Array key of the parameter
     * @return string Previously set default
     */
    public function getDefault($name)
    {
        $default = null;
        foreach ($this->routes as $route) {
            if (method_exists($route, 'getDefault')) {
                $current = $route->getDefault($name);
                if (null !== $current) {
                    $default = $current;
                }
            }
        }

        return $default;
    }

    /**
     * Return an array of defaults
     *
     * @return array Route defaults
     */
    public function getDefaults()
    {
        $defaults = [];
        foreach ($this->routes as $route) {
            if (method_exists($route, 'getDefaults')) {
                $defaults = array_merge($defaults, $route->getDefaults());
            }
        }

        return $defaults;
    }
}
