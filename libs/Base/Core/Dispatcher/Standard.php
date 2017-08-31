<?php

namespace Base\Core\Dispatcher;

use Base\Core\Controller\ControllerInterface;
use Base\Core\Request\RequestAbstract;
use Base\Core\Response\ResponseAbstract;


class Standard extends DispatcherAbstract
{
    /**
     * Processed class name
     * @var string
     */
    protected $controllerClassName;

    /**
     * @var array
     */
    protected $modules = [];

    /**
     *
     */
    public function __construct()
    {
        $path = APP . DS . 'modules';

        try{
            $dir = new \DirectoryIterator($path);
        } catch(\Exception $e) {
            throw new Exception("Directory $path not readable", 0, $e);
        }
        foreach ($dir as $file) {
            if ($file->isDot() || !$file->isDir()) {
                continue;
            }

            $this->modules[] = strtolower($file->getFilename());
        }
    }

    /**
     * Format the module name.
     *
     * @param string $moduleName
     * @return string
     */
    public function formatModuleName($moduleName)
    {
        return ucfirst($this->formatName($moduleName));
    }

    /**
     * Returns TRUE if the RequestAbstract object can be
     * dispatched to a controller.
     *
     * Use this method wisely. By default, the dispatcher will fall back to the
     * default controller (either in the module specified or the global default)
     * if a given controller does not exist. This method returning false does
     * not necessarily indicate the dispatcher will not still dispatch the call.
     *
     * @param RequestAbstract $request
     * @internal param RequestAbstract $action
     * @return boolean
     */
    public function isDispatchable(RequestAbstract $request)
    {
        $className = $this->getControllerClass($request);

        if (!$className) {
            return false;
        }

        if (class_exists($className)) {
            $this->controllerClassName = $className;
            return true;
        }
    }

    /**
     * Dispatch to a controller/action
     *
     * By default, if a controller is not dispatchable, dispatch() will throw
     * an exception. If you wish to use the default controller instead, set the
     * param 'useDefaultControllerAlways' via {@link setParam()}.
     *
     * @param RequestAbstract $request
     * @param ResponseAbstract $response
     * @throws \Exception
     * @return void
     */
    public function dispatch(RequestAbstract $request, ResponseAbstract $response)
    {
        $this->setResponse($response);

        /**
         * Get controller class
         */
        if (!$this->isDispatchable($request)) {
            throw new Exception('Invalid controller specified (' . $request->getControllerName() . ')');
        }

        /**
         * Instantiate controller with request, response, and invocation
         * arguments; throw exception if it's not an action controller
         */
        $controller = new $this->controllerClassName($request, $this->getResponse());
        if (!($controller instanceof ControllerInterface)) {
            throw new Exception(
                'Controller "' . $this->controllerClassName . '" is not an instance of Base\Core\Controller\ControllerInterface'
            );
        }

        /**
         * Retrieve the action name
         */
        $action = $this->getActionMethod($request);

        /**
         * Dispatch the method call
         */
        $request->setDispatched(true);

        $obLevel = ob_get_level();
        ob_start();

        try {
            $controller->dispatch($action);
        } catch (\Exception $e) {
            // Clean output buffer on error
            $curObLevel = ob_get_level();
            if ($curObLevel > $obLevel) {
                do {
                    ob_get_clean();
                    $curObLevel = ob_get_level();
                } while ($curObLevel > $obLevel);
            }
            throw $e;
        }

        $content = ob_get_clean();
        $response->setBody($content);

        // Destroy the page controller instance and reflection objects
        $controller = null;
    }

    /**
     * Get controller class name
     *
     * Try request first; if not found, try pulling from request parameter;
     * if still not found, fallback to default
     *
     * @param RequestAbstract $request
     * @return string|false Returns class name on success
     */
    public function getControllerClass(RequestAbstract $request)
    {
        $controllerName = $request->getControllerName();

        if (empty($controllerName)) {
            $controllerName = $this->getDefaultControllerName();
            $request->setControllerName($controllerName);
        }

        $className = $this->formatControllerName($controllerName);

        $module = $request->getModuleName();
        $controllersDirName = 'Controllers';

        if ($this->isValidModule($module)) {
            return ucfirst($module) . '\\' . $controllersDirName . '\\' . $className;
        } elseif ($this->isValidModule($this->defaultModule)) {
            $request->setModuleName($this->defaultModule);
            return ucfirst($this->defaultModule) . '\\' . $controllersDirName . '\\' . $className;
        } else {
            throw new Exception('No default module defined for this application');
        }
    }

    /**
     * Determine if a given module is valid
     *
     * @param  string $module
     * @return bool
     */
    public function isValidModule($module)
    {
        $module = strtolower($module);
        return in_array($module, $this->modules);
    }

    /**
     * Determine the action name
     *
     * First attempt to retrieve from request; then from request params
     * using action key; default to default action
     *
     * Returns formatted action name
     *
     * @param RequestAbstract $request
     * @return string
     */
    public function getActionMethod(RequestAbstract $request)
    {
        $action = $request->getActionName();
        if (empty($action)) {
            $action = $this->getDefaultAction();
            $request->setActionName($action);
        }

        return $this->formatActionName($action);
    }

    /**
     * Returns TRUE if the $filename is readable, or FALSE otherwise.
     * This function uses the PHP include_path, where PHP's is_readable()
     * does not.
     *
     * @param string   $filename
     * @return boolean
     */
    public static function isReadable($filename)
    {
        if (is_readable($filename)) {
            // Return early if the filename is readable without needing the
            // include_path
            return true;
        }

        if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN'
            && preg_match('/^[a-z]:/i', $filename)
        ) {
            // If on windows, and path provided is clearly an absolute path,
            // return false immediately
            return false;
        }
        return false;
    }
}
