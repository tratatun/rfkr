<?php

namespace Base\Controllers;

use Base\Core\Controller\ControllerAbstract;

/**
 * Class ErrorController
 *
 * @package Base\Controllers
 */
class ErrorController extends Base
{
    /**
     *
     */
    public function errorAction()
    {
        $exception = $this->getRequest()->getParam('error_handler')->exception;

        switch ($exception->getCode()) {
            case 404:
                $this->getResponse()->setHttpResponseCode(404);
                $this->layout->set('content', $this->render('404'));
                echo $this->layout->render();
                break;
            default:
                break;
        }
    }

    /**
     * @see Base\Controllers\Layout
     */
    public function postDispatch()
    {

    }
}