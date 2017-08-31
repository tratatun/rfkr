<?php

namespace Base\Controllers;

use Base\Core\Controller\ControllerAbstract;
use Base\View\View;
use Base\View\ViewInterface;

abstract class Layout extends ControllerAbstract
{
    /**
     * @var View
     */
    protected $layout;

    /**
     *
     */
    public function initLayout()
    {
        if (isset($this->layout) && ($this->layout instanceof ViewInterface)) {
            return $this->layout;
        }

        $baseDir = APP . DS . 'views';

        if (!file_exists($baseDir) || !is_dir($baseDir)) {
            throw new \RuntimeException('Missing base view directory ("' . $baseDir . '")');
        }

        $this->layout = new View($baseDir);
    }

    /**
     * Set layout path
     *
     * @param $path
     */
    public function setLayoutPath($path)
    {
        $this->layout->setTemplateName($path);
    }

    /**
     *
     */
    public function postDispatch()
    {
        $this->layout->set('content', $this->render());
        echo $this->layout->render();
    }
}