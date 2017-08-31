<?php

namespace Base\Core\Request;

/**
 * Class RequestAbstract
 *
 * @package Base\Core
 * @subpackage Base\Core\Request
 */
abstract class RequestAbstract
{
    /**
     * Module
     * @var string
     */
    protected $module;

    /**
     * Module key for retrieving module from params
     * @var string
     */
    protected $moduleKey = 'module';

    /**
     * Controller name
     *
     * @var string
     */
    protected $controller;

    /**
     * Controller key for retrieving controller from params
     * @var string
     */
    protected $controllerKey = 'controller';

    /**
     * Action name
     *
     * @var string
     */
    protected $action;

    /**
     * Action key for retrieving action from params
     * @var string
     */
    protected $actionKey = 'action';

    /**
     * Request parameters
     *
     * @var array
     */
    protected $params = [];

    /**
     * Has the action been dispatched?
     * @var boolean
     */
    protected $dispatched = false;

    /**
     * Set request parameter
     *
     * @param mixed $key
     * @param mixed $value
     * @return $this
     */
    public function setParam($key, $value)
    {
        $key = (string) $key;

        if ((null === $value) && isset($this->params[$key])) {
            unset($this->params[$key]);
        } elseif (null !== $value) {
            $this->params[$key] = $value;
        }
        return $this;
    }

    /**
     * Set request parameters
     *
     * @param array $params
     * @return $this
     */
    public function setParams($params)
    {
        foreach ($params as $key => $value) {
            $this->setParam($key, $value);
        }
        return $this;
    }

    /**
     * Return request parameters
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Retrieve value of specified request parameter
     *
     * @param mixed $key
     * @param mixed $default
     * @return mixed
     */
    public function getParam($key, $default = null)
    {
        $key = (string) $key;

        if (isset($this->params[$key])) {
            return $this->params[$key];
        }
        return $default;
    }

    /**
     * Retrieve the module name
     *
     * @return string
     */
    public function getModuleName()
    {
        if (null === $this->module) {
            $this->module = $this->getParam($this->getModuleKey());
        }

        return $this->module;
    }

    /**
     * Set the module name to use
     *
     * @param string $value
     * @return RequestAbstract
     */
    public function setModuleName($value)
    {
        $this->module = $value;
        return $this;
    }

    /**
     * Retrieve the controller name
     *
     * @return string
     */
    public function getControllerName()
    {
        if (null === $this->controller) {
            $this->controller = $this->getParam($this->getControllerKey());
        }

        return $this->controller;
    }

    /**
     * Set the controller name to use
     *
     * @param string $value
     * @return RequestAbstract
     */
    public function setControllerName($value)
    {
        $this->controller = $value;
        return $this;
    }

    /**
     * Retrieve the action name
     *
     * @return string
     */
    public function getActionName()
    {
        if (null === $this->action) {
            $this->action = $this->getParam($this->getActionKey());
        }

        return $this->action;
    }

    /**
     * Set the action name
     *
     * @param string $value
     * @return RequestAbstract
     */
    public function setActionName($value)
    {
        $this->action = $value;
        return $this;
    }

    /**
     * Retrieve the module key
     *
     * @return string
     */
    public function getModuleKey()
    {
        return $this->moduleKey;
    }

    /**
     * Set the module key
     *
     * @param string $key
     * @return RequestAbstract
     */
    public function setModuleKey($key)
    {
        $this->moduleKey = (string) $key;
        return $this;
    }

    /**
     * Retrieve the controller key
     *
     * @return string
     */
    public function getControllerKey()
    {
        return $this->controllerKey;
    }

    /**
     * Set the controller key
     *
     * @param string $key
     * @return RequestAbstract
     */
    public function setControllerKey($key)
    {
        $this->controllerKey = (string) $key;
        return $this;
    }

    /**
     * Retrieve the action key
     *
     * @return string
     */
    public function getActionKey()
    {
        return $this->actionKey;
    }

    /**
     * Set the action key
     *
     * @param string $key
     * @return RequestAbstract
     */
    public function setActionKey($key)
    {
        $this->actionKey = (string) $key;
        return $this;
    }

    /**
     * Unset all parameters
     */
    public function clearParams()
    {
        $this->params = [];
    }

    /**
     * Set flag indicating whether or not request has been dispatched
     *
     * @param boolean $flag
     * @return RequestAbstract
     */
    public function setDispatched($flag = true)
    {
        $this->dispatched = $flag ? true : false;
        return $this;
    }

    /**
     * Determine if the request has been dispatched
     *
     * @return boolean
     */
    public function isDispatched()
    {
        return $this->dispatched;
    }
}