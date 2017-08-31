<?php

namespace Controllers;

use Base\View;
use Base\Config;
use Base\Mvc\FrontController;

/**
 * Class Errors
 *
 * @package Controllers
 */
final class Errors extends BaseController {

    public function action404() {
        $view = new View(Config::get('application')['view']['frontend']['pathToTemplates']);
        $view->set('baseUrl', FrontController::getInstance()->getBaseUrl());
        $this->assign('content', $view->rend('errors/404.php'));
    }
}