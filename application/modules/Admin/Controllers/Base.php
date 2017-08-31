<?php


namespace Admin\Controllers;

use Base\Auth;
use Base\Controllers\Layout;

/**
 * Class BaseController
 *
 * @package Admin\Controllers
 */
class Base extends Layout
{
    /**
     *
     */
    public function preDispatch()
    {
        if (!Auth::getInstance()->authenticate()) {
            $this->redirect(AuthController::URL_LOGIN);
        }
    }

    /**
     *
     */
    public function init()
    {
        $this->initLayout();
        $this->layout->setTemplateName('admin/layout.phtml');
        $this->layout->set('currentPage', $this->getRequest()->getControllerName());
        $this->layout->set('baseUrl', $this->getRequest()->getBaseUrl());

        $this->initView();
        $this->view->set('baseUrl', $this->getRequest()->getBaseUrl());
    }


}