<?php

namespace Base\Core\Dispatcher;

use Base\Core\FrontController;
use Base\Core\Response\ResponseAbstract;


abstract class DispatcherAbstract implements DispatcherInterface
{
    /**
     * Default action
     * @var string
     */
    protected $defaultAction = 'index';

    /**
     * Default controller
     * @var string
     */
    protected $defaultController = 'index';

    /**
     * Default module
     * @var string
     */
    protected $defaultModule = 'base';

    /**
     * Front Controller instance
     * @var FrontController
     */
    protected $frontController;

    /**
     * Response object to pass to action controllers, if any
     * @var ResponseAbstract|null
     */
    protected $response = null;

    /**
     * Word delimiter characters
     * @var array
     */
    protected $wordDelimiter = array('-', '.');

    /**
     * Formats a string into a controller name.  This is used to take a raw
     * controller name, such as one stored inside a Zend_Controller_Request_Abstract
     * object, and reformat it to a proper class name that a class extending
     * Zend_Controller_Action would use.
     *
     * @param string $unformatted
     * @return string
     */
    public function formatControllerName($unformatted)
    {
        return ucfirst($this->formatName($unformatted)) . 'Controller';
    }

    /**
     * Formats a string into an action name.  This is used to take a raw
     * action name, such as one that would be stored inside a Zend_Controller_Request_Abstract
     * object, and reformat into a proper method name that would be found
     * inside a class extending Zend_Controller_Action.
     *
     * @param string $unformatted
     * @return string
     */
    public function formatActionName($unformatted)
    {
        $formatted = $this->formatName($unformatted, true);
        return strtolower(substr($formatted, 0, 1)) . substr($formatted, 1) . 'Action';
    }

    /**
     * Verify delimiter
     *
     * Verify a delimiter to use in controllers or actions. May be a single
     * string or an array of strings.
     *
     * @param string|array $spec
     * @return array
     * @throws Exception with invalid delimiters
     */
    public function verifyDelimiter($spec)
    {
        if (is_string($spec)) {
            return (array) $spec;
        } elseif (is_array($spec)) {
            $allStrings = true;
            foreach ($spec as $delim) {
                if (!is_string($delim)) {
                    $allStrings = false;
                    break;
                }
            }

            if (!$allStrings) {
                throw new Exception('Word delimiter array must contain only strings');
            }

            return $spec;
        }
        throw new Exception('Invalid word delimiter');
    }

    /**
     * Retrieve the word delimiter character(s) used in
     * controller or action names
     *
     * @return array
     */
    public function getWordDelimiter()
    {
        return $this->wordDelimiter;
    }

    /**
     * Set word delimiter
     *
     * Set the word delimiter to use in controllers and actions. May be a
     * single string or an array of strings.
     *
     * @param string|array $spec
     * @return DispatcherAbstract
     */
    public function setWordDelimiter($spec)
    {
        $spec = $this->verifyDelimiter($spec);
        $this->wordDelimiter = $spec;

        return $this;
    }

    /**
     * Formats a string from a URI into a PHP-friendly name.
     *
     * By default, replaces words separated by the word separator character(s)
     * with camelCaps. If $isAction is false, it also preserves replaces words
     * separated by the path separation character with an underscore, making
     * the following word Title cased. All non-alphanumeric characters are
     * removed.
     *
     * @param string $unformatted
     * @return string
     */
    protected function formatName($unformatted)
    {
        $unformatted = str_replace($this->getWordDelimiter(), ' ', strtolower($unformatted));
        $unformatted = preg_replace('/[^a-z0-9 ]/', '', $unformatted);
        $unformatted = str_replace(' ', '', ucwords($unformatted));

        return $unformatted;
    }

    /**
     * Retrieve front controller instance
     *
     * @return FrontController
     */
    public function getFrontController()
    {
        if (null === $this->frontController) {
            $this->frontController = FrontController::getInstance();
        }

        return $this->frontController;
    }

    /**
     * Set front controller instance
     *
     * @param FrontController $controller
     * @return DispatcherAbstract
     */
    public function setFrontController(FrontController $controller)
    {
        $this->frontController = $controller;
        return $this;
    }

    /**
     * Set response object to pass to action controllers
     *
     * @param ResponseAbstract|null $response
     * @return DispatcherAbstract
     */
    public function setResponse(ResponseAbstract $response = null)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * Return the registered response object
     *
     * @return ResponseAbstract|null
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set the default controller (minus any formatting)
     *
     * @param string $controller
     * @return DispatcherAbstract
     */
    public function setDefaultControllerName($controller)
    {
        $this->defaultController = (string) $controller;
        return $this;
    }

    /**
     * Retrieve the default controller name (minus formatting)
     *
     * @return string
     */
    public function getDefaultControllerName()
    {
        return $this->defaultController;
    }

    /**
     * Set the default action (minus any formatting)
     *
     * @param string $action
     * @return DispatcherAbstract
     */
    public function setDefaultAction($action)
    {
        $this->defaultAction = (string) $action;
        return $this;
    }

    /**
     * Retrieve the default action name (minus formatting)
     *
     * @return string
     */
    public function getDefaultAction()
    {
        return $this->defaultAction;
    }

    /**
     * Set the default module
     *
     * @param string $module
     * @return DispatcherAbstract
     */
    public function setDefaultModule($module)
    {
        $this->defaultModule = (string) $module;
        return $this;
    }

    /**
     * Retrieve the default module
     *
     * @return string
     */
    public function getDefaultModule()
    {
        return $this->defaultModule;
    }
}
