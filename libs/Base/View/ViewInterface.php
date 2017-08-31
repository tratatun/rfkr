<?php

namespace Base\View;

/**
 * Interface ViewInterface
 *
 * @package Base\View
 */
interface ViewInterface
{
    /**
     * Alias for set method
     *
     * @param $name string|array Variable name
     * @param $value mixed Variable value
     */
    public function __set($name, $value = null);

    /**
     * Set template variable
     *
     * @param $name
     * @param $value
     * @throws \Exception
     */
    public function set($name, $value = null);

    /**
     * Get variable in template
     *
     * @param $name
     * @throws \Exception
     * @return string
     */
    public function __get($name);

    /**
     * Check if isset variable
     *
     * @param $name
     * @return bool
     */
    public function __isset($name);

    /**
     * Remove variable front template
     *
     * @param $name
     * @return bool
     */
    public function __unset($name);

    /**
     * Return the template engine object
     *
     * If using a third-party template engine, such as Smarty, patTemplate,
     * phplib, etc, return the template engine object. Useful for calling
     * methods on these objects, such as for setting filters, modifiers, etc.
     *
     * @return mixed
     */
    public function getEngine();

    /**
     * Set path to directory which contains template
     *
     * @param $directory
     */
    public function setTemplateDir($directory);

    /**
     * Render specified template
     *
     * @param $templateName
     * @throws \Exception
     * @return string
     */
    public function render($templateName = null) ;
}