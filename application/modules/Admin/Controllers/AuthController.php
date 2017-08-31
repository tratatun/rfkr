<?php

namespace Admin\Controllers;

use Base\Core\Controller\ControllerAbstract;
use Base\View;
use Base\Auth as Authenticate;

/**
 * Class Auth
 * @package Controllers
 */
final class AuthController extends ControllerAbstract
{
    const URL_LOGIN = '/admin/auth/login';
    const URL_SUCCESS_LOGIN = '/admin/main';

    public function indexAction()
    {
        $this->redirect(self::URL_LOGIN);
    }

    /**
     * Authenticate a user
     */
    public function loginAction()
    {
        if (Authenticate::getInstance()->authenticate()) {
            $this->redirect(self::URL_SUCCESS_LOGIN);
        }

        $authError = false;

        if ($this->getRequest()->isPost()) {
            $login = $this->getRequest()->getPost('login');
            $password = $this->getRequest()->getPost('password');

            if (Authenticate::getInstance()->login($login, $password)) {
                $this->redirect(self::URL_SUCCESS_LOGIN);
            } else {
                $authError = true;
            }
        }

        $this->initView();
        $this->view->set('baseUrl', $this->getRequest()->getBaseUrl());
        $this->view->set('hasError', $authError);
        echo $this->render('login');

    }

    /**
     *
     */
    public function logoutAction()
    {
        if (Authenticate::getInstance()->logout()) {
            $this->redirect(self::URL_LOGIN);
        }
    }
}