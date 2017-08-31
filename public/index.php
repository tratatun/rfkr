<?php

require_once 'init.php';

\Base\Core\FrontController::getInstance()
    ->getRouter()
    ->removeDefaultRoutes()
    ->addRoutes(require 'routes.php');

\Base\Core\FrontController::getInstance()
    ->throwExceptions(false)
    ->dispatch()
    ->getResponse()
    ->send();

