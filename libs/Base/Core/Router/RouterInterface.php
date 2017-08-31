<?php

namespace Base\Core\Router;

use Base\Core\FrontController;
use Base\Core\Request\RequestAbstract;

/**
 * Interface RouterInterface
 *
 * @package Base\Core\Router
 */
interface RouterInterface
{
    /**
     * Processes a request and sets its controller and action.  If
     * no route was possible, an exception is thrown.
     *
     * @param RequestAbstract $request
     * @return RequestAbstract|boolean
     */
    public function route(RequestAbstract $request);

    /**
     * Retrieve Front Controller
     *
     * @return FrontController
     */
    public function getFrontController();

    /**
     * Set Front Controller
     *
     * @param FrontController $controller
     * @return RouterInterface
     */
    public function setFrontController(FrontController $controller);
}
