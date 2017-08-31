<?php

namespace Base\Core;

use Base\Core\Controller\Plugin\ErrorHandler;
use Base\Core\Controller\Plugin\PluginAbstract;
use Base\Core\Request\Http as HttpRequest;
use Base\Core\Response\Http as HttpResponse;
use Base\Core\Controller\Plugin\Broker;
use Base\SingletonTrait;
use Base\Core\Router\RouterInterface;
use Base\Core\Request\RequestAbstract;
use Base\Core\Response\ResponseAbstract;
use Base\Core\Dispatcher\DispatcherInterface;
use Base\Core\Router\Rewrite as RouterRewrite;
use Base\Core\Dispatcher\Standard as StandardDispatcher;

/**
 * Class FrontController
 *
 * @package classes
 * @author Eugene Orekhov <oeswww@gmail.com>
 */
class FrontController {

    use SingletonTrait;

    /**
     * Base url
     *
     * @var string
     */
    protected $baseUrl;

    /**
     * Instance of DispatcherInterface
     *
     * @var DispatcherInterface
     */
    protected $dispatcher = null;

    /**
     * Whether or not exceptions encountered in {@link dispatch()} should be
     * thrown or trapped in the response object
     *
     * @var boolean
     */
    protected $throwExceptions = false;

    /**
     * An instance of front controller
     *
     * @var null|FrontController
     */
    protected static $instance;

    /**
     * Request object
     *
     * @var RequestAbstract
     */
    private $request;

    /**
     * Request object
     *
     * @var ResponseAbstract
     */
    private $response;

    /**
     * Request object
     *
     * @var RouterInterface
     */
    private $router;

    /**
     * Instance of Base\Core\Controller\Plugin\Broker
     *
     * @var Broker
     */
    protected $plugins;

    /**
     * Whether or not to return the response prior to rendering output while in
     * {@link dispatch()}; default is to send headers and render output.
     *
     * @var boolean
     */
    protected $returnResponse = false;

    /**
     * Create an instance of front controller
     */
    public static function getInstance() {

        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Constructor
     *
     * Instantiate using {@link getInstance()}; front controller is a singleton
     * object.
     *
     * Instantiates the plugin broker.
     */
    protected function __construct()
    {
        $this->plugins = new Broker();
    }

    /**
     * Set the default module name
     *
     * @param string $module
     * @return FrontController
     */
    public function setDefaultModule($module)
    {
        $this->getDispatcher()->setDefaultModule($module);
        return $this;
    }

    /**
     * Retrieve the default module
     *
     * @return string
     */
    public function getDefaultModule()
    {
        return $this->getDispatcher()->getDefaultModule();
    }

    /**
     * Set the default controller (unformatted string)
     *
     * @param string $controller
     * @return FrontController
     */
    public function setDefaultControllerName($controller)
    {
        $this->getDispatcher()->setDefaultControllerName($controller);
        return $this;
    }

    /**
     * Retrieve the default controller (unformatted string)
     *
     * @return string
     */
    public function getDefaultControllerName()
    {
        return $this->getDispatcher()->getDefaultControllerName();
    }

    /**
     * Set the default action (unformatted string)
     *
     * @param string $action
     * @return FrontController
     */
    public function setDefaultAction($action)
    {
        $this->getDispatcher()->setDefaultAction($action);
        return $this;
    }

    /**
     * Retrieve the default action (unformatted string)
     *
     * @return string
     */
    public function getDefaultAction()
    {
        return $this->getDispatcher()->getDefaultAction();
    }

    /**
     * Set the dispatcher object.
     *
     * @param DispatcherInterface $dispatcher
     * @return FrontController
     */
    public function setDispatcher(DispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
        return $this;
    }

    /**
     * Return the dispatcher object.
     *
     * @return DispatcherInterface
     */
    public function getDispatcher()
    {
        /**
         * Instantiate the default dispatcher if one was not set.
         */
        if (is_null($this->dispatcher)) {
            $this->dispatcher = new StandardDispatcher();
        }
        return $this->dispatcher;
    }

    /**
     * Set response object
     *
     * Set the response object.  The response is a container for action
     * responses and headers. Usage is optional.
     *
     * If a class name is provided, instantiates a response object.
     *
     * @param ResponseAbstract $response
     * @return FrontController
     */
    public function setResponse(ResponseAbstract $response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * Return the response object.
     *
     * @return ResponseAbstract
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Register a plugin.
     *
     * @param  PluginAbstract $plugin
     * @param  int $stackIndex Optional; stack index for plugin
     * @return FrontController
     */
    public function registerPlugin(PluginAbstract $plugin, $stackIndex = null)
    {
        $this->plugins->registerPlugin($plugin, $stackIndex);
        return $this;
    }

    /**
     * Unregister a plugin.
     *
     * @param  string|PluginAbstract $plugin Plugin class or object to unregister
     * @return FrontController
     */
    public function unregisterPlugin($plugin)
    {
        $this->plugins->unregisterPlugin($plugin);
        return $this;
    }

    /**
     * Is a particular plugin registered?
     *
     * @param  string $class
     * @return bool
     */
    public function hasPlugin($class)
    {
        return $this->plugins->hasPlugin($class);
    }

    /**
     * Retrieve a plugin or plugins by class
     *
     * @param  string $class
     * @return false|PluginAbstract|array
     */
    public function getPlugin($class)
    {
        return $this->plugins->getPlugin($class);
    }

    /**
     * Retrieve all plugins
     *
     * @return array
     */
    public function getPlugins()
    {
        return $this->plugins->getPlugins();
    }

    /**
     * Set the throwExceptions flag and retrieve current status
     *
     * Set whether exceptions encounted in the dispatch loop should be thrown
     * or caught and trapped in the response object.
     *
     * Default behaviour is to trap them in the response object; call this
     * method to have them thrown.
     *
     * Passing no value will return the current value of the flag; passing a
     * boolean true or false value will set the flag and return the current
     * object instance.
     *
     * @param boolean $flag Defaults to null (return flag state)
     * @return boolean|FrontController Used as a setter, returns object; as a getter, returns boolean
     */
    public function throwExceptions($flag = null)
    {
        if ($flag !== null) {
            $this->throwExceptions = (bool) $flag;
            return $this;
        }

        return $this->throwExceptions;
    }

    /**
     * Dispatch an HTTP request to a controller/action.
     *
     * @param RequestAbstract $request
     * @param ResponseAbstract $response
     * @return FrontController
     * @throws \Exception
     */
    public function dispatch(RequestAbstract $request = null, ResponseAbstract $response = null)
    {
        if (!$this->plugins->hasPlugin('Base\Core\Controller\Plugin\ErrorHandler')) {
            $this->plugins->registerPlugin(new ErrorHandler(), 100);
        }

        /**
         * Instantiate default request object (HTTP version) if none provided
         */
        if (null !== $request) {
            $this->setRequest($request);
        } elseif ((null === $request) && (null === ($request = $this->request))) {
            $this->setRequest(new HttpRequest());
        }

        /**
         * Set base URL of request object, if available
         */
        if (is_callable(array($this->request, 'setBaseUrl'))) {
            if (null !== $this->baseUrl) {
                $this->request->setBaseUrl($this->baseUrl);
            }
        }

        /**
         * Instantiate default response object (HTTP version) if none provided
         */
        if (null !== $response) {
            $this->setResponse($response);
        } elseif (null === $this->response) {
            $this->setResponse(new HttpResponse());
        }

        /**
         * Register request and response objects with plugin broker
         */
        $this->plugins
            ->setRequest($this->getRequest())
            ->setResponse($this->getResponse());

        $router = $this->getRouter();
        $dispatcher = $this->getDispatcher();

        // Begin dispatch
        try {
            /**
             * Notify plugins of router startup
             */
            $this->plugins->routeStartup($this->getRequest());

            /**
             * Route request to controller/action, if a router is provided
             */
            try {
                $router->route($this->getRequest());
            }  catch (\Exception $e) {
                if ($this->throwExceptions()) {
                    throw $e;
                }
                $this->response->setException($e);
            }

            /**
             * Notify plugins of router completion
             */
            $this->plugins->routeShutdown($this->getRequest());

            /**
             * Notify plugins of dispatch loop startup
             */
            $this->plugins->dispatchLoopStartup($this->getRequest());

            /**
             *  Attempt to dispatch the controller/action. If the $this->_request
             *  indicates that it needs to be dispatched, move to the next
             *  action in the request.
             */
            do {
                $this->getRequest()->setDispatched(true);

                /**
                 * Notify plugins of dispatch startup
                 */
                $this->plugins->preDispatch($this->getRequest());

                /**
                 * Skip requested action if preDispatch() has reset it
                 */
                if (!$this->request->isDispatched()) {
                    continue;
                }

                /**
                 * Dispatch request
                 */
                try {
                    $dispatcher->dispatch($this->getRequest(), $this->getResponse());
                } catch (\Exception $e) {
                    if ($this->throwExceptions()) {
                        throw $e;
                    }
                    $this->response->setException($e);
                }
                /**
                 * Notify plugins of dispatch completion
                 */
                $this->plugins->postDispatch($this->getRequest());
            } while (!$this->getRequest()->isDispatched());
        } catch (\Exception $e) {
            if ($this->throwExceptions()) {
                throw $e;
            }

            $this->response->setException($e);
        }

        return $this;
    }

    /**
     * Return base url
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * Set request object
     *
     * @param RequestAbstract $request
     * @return FrontController
     */
    public function setRequest(RequestAbstract $request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * Return object of request
     *
     * @return RequestAbstract
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set router
     *
     * Set the router object.  The router is responsible for mapping
     * the request to a controller and action.
     *
     * @param RouterInterface $router
     * @return FrontController
     */
    public function setRouter(RouterInterface $router)
    {
        $router->setFrontController($this);
        $this->router = $router;
        return $this;
    }

    /**
     * Set the base URL used for requests
     *
     * Use to set the base URL segment of the REQUEST_URI to use when
     * determining PATH_INFO, etc. Examples:
     * - /admin
     * - /myapp
     * - /subdir/index.php
     *
     * Note that the URL should not include the full URI. Do not use:
     * - http://example.com/admin
     * - http://example.com/myapp
     * - http://example.com/subdir/index.php
     *
     * If a null value is passed, this can be used as well for autodiscovery (default).
     *
     * @param string $base
     * @return FrontController
     * @throws \InvalidArgumentException for non-string $base
     */
    public function setBaseUrl($base = null)
    {
        if (!is_string($base) && (null !== $base)) {
            throw new \InvalidArgumentException('Rewrite base must be a string');
        }

        $this->baseUrl = $base;

        if ((null !== ($request = $this->request)) && (method_exists($request, 'setBaseUrl'))) {
            $request->setBaseUrl($base);
        }

        return $this;
    }

    /**
     * Return the router object.
     *
     * Instantiates a Zend\Core\Router\Rewrite object if no router currently set.
     *
     * @return RouterInterface
     */
    public function getRouter()
    {
        if (null == $this->router) {
            $this->setRouter(new RouterRewrite());
        }

        return $this->router;
    }
}