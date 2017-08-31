<?php

namespace Base\Core\Router;

use Base\Core\FrontController;

/**
 * Simple first implementation of a router, to be replaced
 * with rules-based URI processor.
 */
abstract class RouterAbstract implements RouterInterface
{
    /**
     * URI delimiter
     */
    const URI_DELIMITER = '/';
    
    /**
     * Front controller instance
     * @var FrontController
     */
    protected $frontController;

    /**
     * Retrieve Front Controller
     *
     * @return FrontController
     */
    public function getFrontController()
    {
        // Used cache version if found
        if (null !== $this->frontController) {
            return $this->frontController;
        }

        $this->frontController = FrontController::getInstance();
        return $this->frontController;
    }

    /**
     * Set Front Controller
     *
     * @param FrontController $controller
     * @return RouterInterface
     */
    public function setFrontController(FrontController $controller)
    {
        $this->frontController = $controller;
        return $this;
    }

}
