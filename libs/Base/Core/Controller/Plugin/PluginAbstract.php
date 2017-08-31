<?php

namespace Base\Core\Controller\Plugin;

use Base\Core\Request\RequestAbstract;
use Base\Core\Response\ResponseAbstract;

abstract class PluginAbstract
{
    /**
     * @var RequestAbstract
     */
    protected $request;

    /**
     * @var ResponseAbstract
     */
    protected $response;

    /**
     * Set request object
     *
     * @param RequestAbstract $request
     * @return ResponseAbstract
     */
    public function setRequest(RequestAbstract $request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * Get request object
     *
     * @return RequestAbstract $request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set response object
     *
     * @param ResponseAbstract $response
     * @return ResponseAbstract
     */
    public function setResponse(ResponseAbstract $response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * Get response object
     *
     * @return ResponseAbstract $response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Called before \Base\Core\FrontController begins evaluating the
     * request against its routes.
     *
     * @param RequestAbstract $request
     * @return void
     */
    public function routeStartup(RequestAbstract $request)
    {}

    /**
     * Called after \Base\Core\Router exits.
     *
     * Called after FrontController exits from the router.
     *
     * @param  RequestAbstract $request
     * @return void
     */
    public function routeShutdown(RequestAbstract $request)
    {}

    /**
     * Called before \Base\Core\FrontController enters its dispatch loop.
     *
     * @param  RequestAbstract $request
     * @return void
     */
    public function dispatchLoopStartup(RequestAbstract $request)
    {}

    /**
     * Called before an action is dispatched by \Base\Core\Dispatcher.
     *
     * This callback allows for proxy or filter behavior. By altering the
     * request and resetting its dispatched flag (via
     * {@link RequestAbstract::setDispatched() setDispatched(false)}),
     * the current action may be skipped.
     *
     * @param  RequestAbstract $request
     * @return void
     */
    public function preDispatch(RequestAbstract $request)
    {}

    /**
     * Called after an action is dispatched by \Base\Core\Dispatcher.
     *
     * This callback allows for proxy or filter behavior. By altering the
     * request and resetting its dispatched flag (via
     * {@link RequestAbstract::setDispatched() setDispatched(false)}),
     * a new action may be specified for dispatching.
     *
     * @param  RequestAbstract $request
     * @return void
     */
    public function postDispatch(RequestAbstract $request)
    {}

    /**
     * Called before \Base\Core\FrontController exits its dispatch loop.
     *
     * @return void
     */
    public function dispatchLoopShutdown()
    {}
}