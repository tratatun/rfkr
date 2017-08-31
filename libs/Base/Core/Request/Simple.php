<?php

namespace Base\Core\Request;

/**
 * Class Simple
 * @package Base\Core
 * @subpackage Base\Core\Request
 */
class Simple extends RequestAbstract
{
    /**
     * @param null $action Action name
     * @param null $controller Controller name
     * @param null $module Module name
     * @param array $params Various parameters
     */
    public function __construct($action = null, $controller = null, $module = null, array $params = [])
    {
        if ($action) {
            $this->setActionName($action);
        }

        if ($controller) {
            $this->setControllerName($controller);
        }

        if ($module) {
            $this->setModuleName($module);
        }

        if ($params) {
            $this->setParams($params);
        }
    }

}
