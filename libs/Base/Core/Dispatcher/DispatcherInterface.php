<?php

namespace Base\Core\Dispatcher;

use \Base\Core\Request\RequestAbstract;
use \Base\Core\Response\ResponseAbstract;

/**
 *
 */
interface DispatcherInterface
{
    /**
     * Dispatches a request object to a controller/action. If the action
     * requests a forward to another action, a new request will be returned.
     *
     * @param  RequestAbstract $request
     * @param  ResponseAbstract $response
     * @return void
     */
    public function dispatch(RequestAbstract $request, ResponseAbstract $response);

    /**
     * Whether or not a given module is valid
     *
     * @param string $module
     * @return boolean
     */
    public function isValidModule($module);

    /**
     * Retrieve the default module name
     *
     * @return string
     */
    public function getDefaultModule();

    /**
     * Retrieve the default controller name
     *
     * @return string
     */
    public function getDefaultControllerName();

    /**
     * Retrieve the default action
     *
     * @return string
     */
    public function getDefaultAction();
}
