<?php

namespace Base\Core\Controller\Plugin;

use Base\Core\FrontController;
use Base\Core\Request\RequestAbstract;
use Base\Core\Response\ResponseAbstract;

/**
 * Class Broker
 *
 * @package Base\Core\Controller\Plugin
 * @author Eugene Orekhov <oeswww@gmail.com>
 */
class Broker extends PluginAbstract
{
    /**
     * Array of instance of objects extending PluginAbstract
     *
     * @var array
     */
    protected $plugins = [];

    /**
     * Register a plugin.
     *
     * @param  PluginAbstract $plugin
     * @param  int $stackIndex
     * @return Broker
     */
    public function registerPlugin(PluginAbstract $plugin, $stackIndex = null)
    {
        if (false !== array_search($plugin, $this->plugins, true)) {
            throw new \InvalidArgumentException('Plugin already registered');
        }

        $stackIndex = (int) $stackIndex;

        if ($stackIndex) {
            if (isset($this->plugins[$stackIndex])) {
                throw new \InvalidArgumentException('Plugin with stackIndex "' . $stackIndex . '" already registered');
            }
            $this->plugins[$stackIndex] = $plugin;
        } else {
            $stackIndex = count($this->plugins);
            while (isset($this->plugins[$stackIndex])) {
                ++$stackIndex;
            }
            $this->plugins[$stackIndex] = $plugin;
        }

        $request = $this->getRequest();
        if ($request) {
            $plugin->setRequest($request);
        }
        $response = $this->getResponse();
        if ($response) {
            $plugin->setResponse($response);
        }

        ksort($this->plugins);

        return $this;
    }

    /**
     * Unregister a plugin.
     *
     * @param string|PluginAbstract $plugin Plugin object or class name
     * @return Broker
     */
    public function unregisterPlugin($plugin)
    {
        if ($plugin instanceof PluginAbstract) {
            // Given a plugin object, find it in the array
            $key = array_search($plugin, $this->plugins, true);
            if (false === $key) {
                throw new \RuntimeException('Plugin never registered.');
            }
            unset($this->plugins[$key]);
        } elseif (is_string($plugin)) {
            // Given a plugin class, find all plugins of that class and unset them
            foreach ($this->plugins as $key => $_plugin) {
                $type = get_class($_plugin);
                if ($plugin == $type) {
                    unset($this->plugins[$key]);
                }
            }
        }
        return $this;
    }
    
    /**
     * Is a plugin of a particular class registered?
     *
     * @param  string $class
     * @return bool
     */
    public function hasPlugin($class)
    {
        foreach ($this->plugins as $plugin) {
            $type = get_class($plugin);
            if ($class == $type) {
                return true;
            }
        }
        return false;
    }

    /**
     * Retrieve all plugins
     *
     * @return array
     */
    public function getPlugins()
    {
        return $this->plugins;
    }

    /**
     * Retrieve a plugin or plugins by class
     *
     * @param  string $class Class name of plugin(s) desired
     * @return false|PluginAbstract|array Returns false if none found, plugin if only one found, and array of plugins if multiple plugins of same class found
     */
    public function getPlugin($class)
    {
        $found = array();
        foreach ($this->plugins as $plugin) {
            $type = get_class($plugin);
            if ($class == $type) {
                $found[] = $plugin;
            }
        }

        switch (count($found)) {
            case 0:
                return false;
            case 1:
                return $found[0];
            default:
                return $found;
        }
    }

    /**
     * Set request object, and register with each plugin
     *
     * @param RequestAbstract $request
     * @return Broker
     */
    public function setRequest(RequestAbstract $request)
    {
        $this->request = $request;

        /** @var PluginAbstract $plugin */
        foreach ($this->plugins as $plugin) {
            $plugin->setRequest($request);
        }

        return $this;
    }

    /**
     * Set response object
     *
     * @param ResponseAbstract $response
     * @return Broker
     */
    public function setResponse(ResponseAbstract $response)
    {
        $this->response = $response;
        /** @var PluginAbstract $plugin */
        foreach ($this->plugins as $plugin) {
            $plugin->setResponse($response);
        }


        return $this;
    }

    /**
     * Called before FrontController begins evaluating the
     * request against its routes.
     *
     * @param RequestAbstract $request
     * @throws \Exception
     * @return void
     */
    public function routeStartup(RequestAbstract $request)
    {
        foreach ($this->plugins as $plugin) {
            try {
                /** @var PluginAbstract $plugin */
                $plugin->routeStartup($request);
            } catch (\Exception $e) {
                if (FrontController::getInstance()->throwExceptions()) {
                    throw new \Exception($e->getMessage() . $e->getTraceAsString(), $e->getCode(), $e);
                } else {
                    $this->getResponse()->setException($e);
                }
            }
        }
    }


    /**
     * Called before FrontController exits its iterations over
     * the route set.
     *
     * @param  RequestAbstract $request
     * @throws \Exception
     * @return void
     */
    public function routeShutdown(RequestAbstract $request)
    {
        foreach ($this->plugins as $plugin) {
            try {
                /** @var PluginAbstract $plugin */
                $plugin->routeShutdown($request);
            } catch (\Exception $e) {
                if (FrontController::getInstance()->throwExceptions()) {
                    throw new \Exception($e->getMessage() . $e->getTraceAsString(), $e->getCode(), $e);
                } else {
                    $this->getResponse()->setException($e);
                }
            }
        }
    }


    /**
     * Called before FrontController enters its dispatch loop.
     *
     * During the dispatch loop, FrontController keeps a
     * RequestAbstract object, and uses
     * Zend_Controller_Dispatcher to dispatch the
     * RequestAbstract object to controllers/actions.
     *
     * @param  RequestAbstract $request
     * @throws \Exception
     * @return void
     */
    public function dispatchLoopStartup(RequestAbstract $request)
    {
        foreach ($this->plugins as $plugin) {
            try {
                /** @var PluginAbstract $plugin */
                $plugin->dispatchLoopStartup($request);
            } catch (\Exception $e) {
                if (FrontController::getInstance()->throwExceptions()) {
                    throw new \Exception($e->getMessage() . $e->getTraceAsString(), $e->getCode(), $e);
                } else {
                    $this->getResponse()->setException($e);
                }
            }
        }
    }


    /**
     * Called before an action is dispatched by Zend_Controller_Dispatcher.
     *
     * @param  RequestAbstract $request
     * @throws \Exception
     * @return void
     */
    public function preDispatch(RequestAbstract $request)
    {
        foreach ($this->plugins as $plugin) {
            try {
                /** @var PluginAbstract $plugin */
                $plugin->preDispatch($request);
            } catch (\Exception $e) {
                if (FrontController::getInstance()->throwExceptions()) {
                    throw new \Exception($e->getMessage() . $e->getTraceAsString(), $e->getCode(), $e);
                } else {
                    $this->getResponse()->setException($e);
                    // skip rendering of normal dispatch give the error handler a try
                    $this->getRequest()->setDispatched(false);
                }
            }
        }
    }


    /**
     * Called after an action is dispatched by Zend_Controller_Dispatcher.
     *
     * @param  RequestAbstract $request
     * @throws \Exception
     * @return void
     */
    public function postDispatch(RequestAbstract $request)
    {
        foreach ($this->plugins as $plugin) {
            try {
                /** @var PluginAbstract $plugin */
                $plugin->postDispatch($request);
            } catch (\Exception $e) {
                if (FrontController::getInstance()->throwExceptions()) {
                    throw new \Exception($e->getMessage() . $e->getTraceAsString(), $e->getCode(), $e);
                } else {
                    $this->getResponse()->setException($e);
                }
            }
        }
    }


    /**
     * Called before FrontController exits its dispatch loop.
     *
     * @throws \Exception
     * @internal param RequestAbstract $request
     * @return void
     */
    public function dispatchLoopShutdown()
    {
        foreach ($this->plugins as $plugin) {
            try {
                /** @var PluginAbstract $plugin */
                $plugin->dispatchLoopShutdown();
            } catch (\Exception $e) {
                if (FrontController::getInstance()->throwExceptions()) {
                    throw new \Exception($e->getMessage() . $e->getTraceAsString(), $e->getCode(), $e);
                } else {
                    $this->getResponse()->setException($e);
                }
            }
        }
    }
}