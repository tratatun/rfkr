<?php

namespace Base\Core\Controller;

use Base\Core\Response\ResponseAbstract;
use Base\Core\Request\RequestAbstract;


interface ControllerInterface
{
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
    public function __construct(RequestAbstract $request, ResponseAbstract $response);

    /**
     * Dispatch the requested action
     *
     * @param string $action Method name of action
     * @return void
     */
    public function dispatch($action);
}
