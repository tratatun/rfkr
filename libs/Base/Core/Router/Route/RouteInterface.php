<?php

namespace Base\Core\Router\Route;

/**
 * @package Base/Core
 * @subpackage Router
 */
interface RouteInterface {
    /**
     *
     * @param $path
     * @return mixed
     */
    public function match($path);
}

