<?php

namespace Base\Core\Controller;

use Base\Core\FrontController;
use Base\Core\Response\ResponseAbstract;
use Base\Core\Request\RequestAbstract;
use Base\View\View;
use Base\View\ViewInterface;

/**
 * Abstract controller
 *
 * @subpackage Base\Core
 * @subpackage Base\Core\Controller
 */
abstract class ControllerAbstract implements ControllerInterface
{
    /**
     * Front controller instance
     * @var FrontController
     */
    protected $frontController;

    /**
     * RequestAbstract object wrapping the request environment
     * @var RequestAbstract
     */
    protected $request = null;

    /**
     * ResponseAbstract object wrapping the response
     * @var ResponseAbstract
     */
    protected $response = null;

    /**
     * View script suffix; defaults to 'phtml'
     * @see {render()}
     * @var string
     */
    public $viewSuffix = 'phtml';

    /**
     * View object
     * @var View
     */
    public $view;

    /**
     * Class constructor
     *
     * The request and response objects should be registered with the
     * controller; these will be
     * available via {@link getRequest()}, {@link getResponse()}, respectively.
     *
     * When overriding the constructor, please consider this usage as a best
     * practice and ensure that each is registered appropriately; the easiest
     * way to do so is to simply call parent::__construct($request, $response).
     *
     * Finally, {@link init()} is called as the final action of
     * instantiation, and may be safely overridden to perform initialization
     * tasks; as a general rule, override {@link init()} instead of the
     * constructor to customize an action controller's instantiation.
     *
     * @param RequestAbstract $request
     * @param ResponseAbstract $response
     */
    public function __construct(RequestAbstract $request, ResponseAbstract $response)
    {
        $this->setRequest($request)
             ->setResponse($response);

        $this->init();
    }

    /**
     * Initialize object
     *
     * Called from {@link __construct()} as final step of object instantiation.
     *
     * @return void
     */
    public function init()
    {
    }

    /**
     * Initialize View object
     *
     * Initializes {@link $view} if not otherwise a ViewInterface.
     *
     * @return View
     * @throws Exception if base view directory does not exist
     */
    public function initView()
    {
        if (isset($this->view) && ($this->view instanceof ViewInterface)) {
            return $this->view;
        }

        $baseDir = APP . DS . 'views';
        if (!file_exists($baseDir) || !is_dir($baseDir)) {
            throw new Exception('Missing base view directory ("' . $baseDir . '")');
        }

        $this->view = new View($baseDir);

        return $this->view;
    }

    /**
     * Render a view
     *
     * Renders a view. By default, views are found in the view script path as
     * <controller>/<action>.phtml. You may change the script suffix by
     * resetting {@link $viewSuffix}. You may omit the controller directory
     * prefix by specifying boolean true for $noController.
     *
     * @param  string|null $action Defaults to action registered in request object
     * @param  bool $noController Defaults to false; i.e. use controller name as subdir in which to search for view script
     * @return string
     */
    public function render($action = null, $noController = false)
    {
        /** @var View $view */
        $view   = $this->initView();
        $script = $this->getViewScript($action, $noController);
        return $view->render($script);
    }

    /**
     * Render a given view script
     *
     * Similar to {@link render()}, this method renders a view script. Unlike render(),
     * however, it does not autodetermine the view script via {@link getViewScript()},
     * but instead renders the script passed to it. Use this if you know the
     * exact view script name and path you wish to use, or if using paths that do not
     * conform to the spec defined with getViewScript().
     *
     * @return string
     */
    public function renderScript($script)
    {
        $view = $this->initView();
        return $view->render($script);
    }

    /**
     * Construct view script path
     *
     * Used by render() to determine the path to the view script.
     *
     * @param  string $action Defaults to action registered in request object
     * @param  bool $noController  Defaults to false; i.e. use controller name as subdir in which to search for view script
     * @return string
     * @throws Exception with bad $action
     */
    public function getViewScript($action = null, $noController = null)
    {
        $request = $this->getRequest();
        if (null === $action) {
            $action = $request->getActionName();
        } elseif (!is_string($action)) {
            throw new Exception('Invalid action specifier for view render');
        }

        $delimiters = ['-', '.'];
        $script = str_replace($delimiters, '-', $request->getModuleName());


        if (!$noController) {
            $controller = $request->getControllerName();
            $controller = str_replace($delimiters, '-', $controller);
            $script .= DS . $controller;
        }
        $action = str_replace($delimiters, '-', $action);
        $script .= DS . $action . '.' . $this->viewSuffix;

        return $script;
    }

    /**
     * Return the Request object
     *
     * @return RequestAbstract
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set the Request object
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
     * Return the Response object
     *
     * @return ResponseAbstract
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set the Response object
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
     * Set the front controller instance
     *
     * @param FrontController $front
     * @return ControllerAbstract
     */
    public function setFrontController(FrontController $front)
    {
        $this->frontController = $front;
        return $this;
    }

    /**
     * Retrieve Front Controller
     *
     * @return FrontController
     */
    public function getFrontController()
    {
        // Used cache version if found
        if (null !== $this->frontController) {
            $this->frontController = FrontController::getInstance();
        }
        return $this->frontController;
    }

    /**
     * Pre-dispatch routines
     *
     * Called before action method
     *
     * @return void
     */
    public function preDispatch()
    {
    }

    /**
     * Post-dispatch routines
     *
     * Called after action method execution.
     *
     * Common usages for postDispatch() include rendering content in a sitewide
     * template, link url correction, setting headers, etc.
     *
     * @return void
     */
    public function postDispatch()
    {
    }

    /**
     * Proxy for undefined methods.  Default behavior is to throw an
     * exception on undefined methods, however this function can be
     * overridden to implement magic (dynamic) actions, or provide run-time
     * dispatching.
     *
     * @param  string $methodName
     * @param  array $args
     * @return void
     * @throws Exception
     */
    public function __call($methodName, $args)
    {
        if ('Action' == substr($methodName, -6)) {
            $action = substr($methodName, 0, strlen($methodName) - 6);
            throw new Exception(sprintf('Action "%s" does not exist and was not trapped in __call()', $action), 404);
        }

        throw new Exception(sprintf('Method "%s" does not exist and was not trapped in __call()', $methodName), 500);
    }

    /**
     * Dispatch the requested action
     *
     * @param string $action Method name of action
     * @return void
     */
    public function dispatch($action)
    {
        $this->preDispatch();
        if ($this->getRequest()->isDispatched()) {
            $this->$action();
            $this->postDispatch();
        }
    }

    /**
     * Gets a parameter from the {@link $request Request object}.  If the
     * parameter does not exist, NULL will be returned.
     *
     * If the parameter does not exist and $default is set, then
     * $default will be returned instead of NULL.
     *
     * @param string $paramName
     * @param mixed $default
     * @return mixed
     */
    public function getParam($paramName, $default = null)
    {
        $value = $this->getRequest()->getParam($paramName, $default);

        return $value;
    }

    /**
     * Set a parameter in the {@link $request Request object}.
     *
     * @param string $paramName
     * @param mixed $value
     * @return ControllerAbstract
     */
    public function setParam($paramName, $value)
    {
        $this->getRequest()->setParam($paramName, $value);

        return $this;
    }

    /**
     * Determine whether a given parameter exists in the
     * {@link $request Request object}.
     *
     * @param string $paramName
     * @return boolean
     */
    public function hasParam($paramName)
    {
        return null !== $this->getRequest()->getParam($paramName);
    }

    /**
     * Return all parameters in the {@link $request Request object}
     * as an associative array.
     *
     * @return array
     */
    public function getAllParams()
    {
        return $this->getRequest()->getParams();
    }

    /**
     * Redirect to another URL
     *
     * @param string $url
     * @param int $code
     * @return void
     */
    public function redirect($url, $code = 302)
    {
        $this->getResponse()->setRedirect($url, $code)->sendHeaders();
        exit;
    }
}
