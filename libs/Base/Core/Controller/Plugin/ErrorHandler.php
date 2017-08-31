<?php

namespace Base\Core\Controller\Plugin;
use Base\Core\FrontController;
use Base\Core\Request\RequestAbstract;

/**
 * Handle exceptions that bubble up based on missing controllers, actions, or
 * application errors, and forward to an error handler.
 *
 * @package Base\Core\Controller\Plugin
 * @author Eugene Orekhov <oeswww@gmail.com>
 */
class ErrorHandler extends PluginAbstract
{
    /**
     * Const - No controller exception; controller does not exist
     */
    const EXCEPTION_NO_CONTROLLER = 'EXCEPTION_NO_CONTROLLER';

    /**
     * Const - No action exception; controller exists, but action does not
     */
    const EXCEPTION_NO_ACTION = 'EXCEPTION_NO_ACTION';

    /**
     * Const - No route exception; no routing was possible
     */
    const EXCEPTION_NO_ROUTE = 'EXCEPTION_NO_ROUTE';

    /**
     * Const - Other Exception; exceptions thrown by application controllers
     */
    const EXCEPTION_OTHER = 'EXCEPTION_OTHER';

    /**
     * Module to use for errors; defaults to default module in dispatcher
     * @var string
     */
    protected $errorModule;

    /**
     * Controller to use for errors; defaults to 'error'
     * @var string
     */
    protected $errorController = 'error';

    /**
     * Action to use for errors; defaults to 'error'
     * @var string
     */
    protected $errorAction = 'error';

    /**
     * Flag; are we already inside the error handler loop?
     * @var bool
     */
    protected $isInsideErrorHandlerLoop = false;

    /**
     * Exception count logged at first invocation of plugin
     * @var int
     */
    protected $exceptionCountAtFirstEncounter = 0;

    /**
     * Constructor
     *
     * Options may include:
     * - module
     * - controller
     * - action
     *
     * @param  Array $options
     */
    public function __construct(array $options = array())
    {
        $this->setErrorHandler($options);
    }

    /**
     * setErrorHandler() - setup the error handling options
     *
     * @param  array $options
     * @return ErrorHandler
     */
    public function setErrorHandler(Array $options = array())
    {
        if (isset($options['module'])) {
            $this->setErrorHandlerModule($options['module']);
        }
        if (isset($options['controller'])) {
            $this->setErrorHandlerController($options['controller']);
        }
        if (isset($options['action'])) {
            $this->setErrorHandlerAction($options['action']);
        }
        return $this;
    }

    /**
     * Set the module name for the error handler
     *
     * @param  string $module
     * @return ErrorHandler
     */
    public function setErrorHandlerModule($module)
    {
        $this->errorModule = (string) $module;
        return $this;
    }

    /**
     * Retrieve the current error handler module
     *
     * @return string
     */
    public function getErrorHandlerModule()
    {
        if (null === $this->errorModule) {
            $this->errorModule = FrontController::getInstance()->getDispatcher()->getDefaultModule();
        }
        return $this->errorModule;
    }

    /**
     * Set the controller name for the error handler
     *
     * @param  string $controller
     * @return ErrorHandler
     */
    public function setErrorHandlerController($controller)
    {
        $this->errorController = (string) $controller;
        return $this;
    }

    /**
     * Retrieve the current error handler controller
     *
     * @return string
     */
    public function getErrorHandlerController()
    {
        return $this->errorController;
    }

    /**
     * Set the action name for the error handler
     *
     * @param  string $action
     * @return ErrorHandler
     */
    public function setErrorHandlerAction($action)
    {
        $this->errorAction = (string) $action;
        return $this;
    }

    /**
     * Retrieve the current error handler action
     *
     * @return string
     */
    public function getErrorHandlerAction()
    {
        return $this->errorAction;
    }

    /**
     * Route shutdown hook -- Check for router exceptions
     *
     * @param RequestAbstract $request
     */
    public function routeShutdown(RequestAbstract $request)
    {
        $this->handleError($request);
    }

    /**
     * Pre dispatch hook -- check for exceptions and dispatch error handler if
     * necessary
     *
     * @param RequestAbstract $request
     */
    public function preDispatch(RequestAbstract $request)
    {
        $this->handleError($request);
    }

    /**
     * Post dispatch hook -- check for exceptions and dispatch error handler if
     * necessary
     *
     * @param RequestAbstract $request
     */
    public function postDispatch(RequestAbstract $request)
    {
        $this->handleError($request);
    }

    /**
     * Handle errors and exceptions
     *
     * @param  RequestAbstract $request
     * @throws mixed
     * @return void
     */
    protected function handleError(RequestAbstract $request)
    {
        $response = $this->getResponse();

        if ($this->isInsideErrorHandlerLoop) {
            $exceptions = $response->getException();
            if (count($exceptions) > $this->exceptionCountAtFirstEncounter) {
                // Exception thrown by error handler; tell the front controller to throw it
                FrontController::getInstance()->throwExceptions(true);
                throw array_pop($exceptions);
            }
        }

        // check for an exception AND allow the error handler controller the option to forward
        if (($response->isException()) && (!$this->isInsideErrorHandlerLoop)) {
            $this->isInsideErrorHandlerLoop = true;

            // Get exception information
            $error            = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
            $exceptions       = $response->getException();
            /** @var \Exception $exception */
            $exception        = $exceptions[0];
            $exceptionType    = get_class($exception);
            $error->exception = $exception;
            switch ($exceptionType) {
                case 'Base\Core\Router\Exception':
                    if (404 == $exception->getCode()) {
                        $error->type = self::EXCEPTION_NO_ROUTE;
                    } else {
                        $error->type = self::EXCEPTION_OTHER;
                    }
                    break;
                case 'Base\Core\Dispatcher\Exception':
                    $error->type = self::EXCEPTION_NO_CONTROLLER;
                    break;
                case 'Base\Core\Controller\Exception':
                    if (404 == $exception->getCode()) {
                        $error->type = self::EXCEPTION_NO_ACTION;
                    } else {
                        $error->type = self::EXCEPTION_OTHER;
                    }
                    break;
                default:
                    $error->type = self::EXCEPTION_OTHER;
                    break;
            }

            // Keep a copy of the original request
            $error->request = clone $request;

            // get a count of the number of exceptions encountered
            $this->exceptionCountAtFirstEncounter = count($exceptions);

            // Forward to the error handler
            $request->setParam('error_handler', $error)
                ->setModuleName($this->getErrorHandlerModule())
                ->setControllerName($this->getErrorHandlerController())
                ->setActionName($this->getErrorHandlerAction())
                ->setDispatched(false);
        }
    }
}