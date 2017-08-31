<?php

namespace Base\Core\Router\Route;

use Base\Core\Dispatcher\DispatcherInterface;
use Base\Core\FrontController;
use Base\Core\Request\RequestAbstract;

/**
 * Module Route
 *
 * Default route for module functionality
 */
class Module extends RouteAbstract
{
    /**
     * Default values for the route (ie. module, controller, action, params)
     * @var array
     */
    protected $defaults;

    protected $values      = [];
    protected $moduleValid = false;
    protected $keysSet     = false;

    /**#@+
     * Array keys to use for module, controller, and action. Should be taken out of request.
     * @var string
     */
    protected $moduleKey     = 'module';
    protected $controllerKey = 'controller';
    protected $actionKey     = 'action';
    /**#@-*/

    /**
     * @var DispatcherInterface
     */
    protected $dispatcher;

    /**
     * @var RequestAbstract
     */
    protected $request;

    /**
     * Constructor
     *
     * @param array $defaults Defaults for map variables with keys as variable names
     * @param DispatcherInterface $dispatcher Dispatcher object
     * @param RequestAbstract $request Request object
     */
    public function __construct(array $defaults = [], DispatcherInterface $dispatcher = null,
                RequestAbstract $request = null
    ) {
        $this->defaults = $defaults;

        if (isset($request)) {
            $this->request = $request;
        }

        if (isset($dispatcher)) {
            $this->dispatcher = $dispatcher;
        }
    }

    /**
     * Set request keys based on values in request object
     *
     * @return void
     */
    protected function setRequestKeys()
    {
        if (null !== $this->request) {
            $this->moduleKey     = $this->request->getModuleKey();
            $this->controllerKey = $this->request->getControllerKey();
            $this->actionKey     = $this->request->getActionKey();
        }

        if (null !== $this->dispatcher) {
            $this->defaults += array(
                $this->controllerKey => $this->dispatcher->getDefaultControllerName(),
                $this->actionKey     => $this->dispatcher->getDefaultAction(),
                $this->moduleKey     => $this->dispatcher->getDefaultModule()
            );
        }

        $this->keysSet = true;
    }

    /**
     * Matches a user submitted path. Assigns and returns an array of variables
     * on a successful match.
     *
     * If a request object is registered, it uses its setModuleName(),
     * setControllerName(), and setActionName() accessors to set those values.
     * Always returns the values as an array.
     *
     * @param string $path Path used to match against this routing map
     * @return array An array of assigned values or a false on a mismatch
     */
    public function match($path, $partial = false)
    {
        $this->setRequestKeys();

        $values = [];
        $params = [];

        if (!$partial) {
            $path = trim($path, self::URI_DELIMITER);
        } else {
            $matchedPath = $path;
        }

        if ($path != '') {
            $path = explode(self::URI_DELIMITER, $path);

            if ($this->dispatcher && $this->dispatcher->isValidModule($path[0])) {
                $values[$this->moduleKey] = array_shift($path);
                $this->moduleValid = true;
            }

            if (count($path) && !empty($path[0])) {
                $values[$this->controllerKey] = array_shift($path);
            }

            if (count($path) && !empty($path[0])) {
                $values[$this->actionKey] = array_shift($path);
            }

            if ($numSegs = count($path)) {
                for ($i = 0; $i < $numSegs; $i = $i + 2) {
                    $key = urldecode($path[$i]);
                    $val = isset($path[$i + 1]) ? urldecode($path[$i + 1]) : null;
                    $params[$key] = (isset($params[$key]) ? (array_merge((array) $params[$key], array($val))): $val);
                }
            }
        }

        if ($partial) {
            $this->setMatchedPath($matchedPath);
        }

        $this->values = $values + $params;

        return $this->values + $this->defaults;
    }

}
