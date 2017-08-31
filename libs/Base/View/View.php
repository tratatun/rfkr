<?php

namespace Base\View;

use Base\I18n;

/**
 * Class View
 *

 * @package classes
 * @author Eugene Orekhov <oeswww@gmail.com>
 */
class View implements ViewInterface
{
    /**
     * Path to template files
     *
     * @var null|string
     */
    private $templatesDir;

    /**
     * File name of template
     *
     * @var null|string
     */
    private $templateName;

    /**
     * Output data
     *
     * @var array
     */
    private $_ = [];

    /**
     * Class initialization
     *
     * @param $templateDir
     * @throws \Exception
     */
    public function __construct($templateDir = null)
    {
        if (!empty($templateDir)) {
            $this->templatesDir = $templateDir;
        }

    }

    /**
     * Return the template engine object
     *
     * Returns the object instance, as it is its own template engine
     *
     * @return null
     */
    public function getEngine()
    {
        return null;
    }

    /**
     * Alias for set method
     *
     * @param $name string|array Variable name
     * @param $value mixed Variable value
     */
    public function __set($name, $value = null)
    {
        $this->set($name, $value);
    }

    /**
     * Set template variable
     *
     * @param $name
     * @param $value
     * @return $this
     */
    public function set($name, $value = null)
    {
        if (is_array($name)) {
            foreach ($name as $key => $value) {
                $this->set($key, $value);
            }
        } else {
            $name = (string) $name;
            $this->_[$name] = $value;
        }
        return $this;
    }

    /**
     * Get variable in template
     *
     * @param $name
     * @throws \RuntimeException
     * @return string
     */
    public function __get($name)
    {
        if (!isset($this->_[$name])) {
            throw new \RuntimeException('Variable ' . $name . ' is not defined');
        }

        return $this->_[$name];
    }

    /**
     * Check if isset variable
     *
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->_[$name]);
    }

    /**
     * Remove variable front template
     *
     * @param $name
     * @return bool
     */
    public function __unset($name)
    {
        unset($this->_[$name]);
    }

    /**
     * Set path to directory which contains template
     *
     * @param $directory
     */
    public function setTemplateDir($directory)
    {
        $this->templatesDir = $directory;
    }

    /**
     * Set template file name
     *
     * @param $name
     */
    public function setTemplateName($name)
    {
        $this->templateName = $name;
    }

    /**
     * Render template
     *
     * @param $templateName
     * @throws \RuntimeException
     * @throws \Exception
     * @return string
     */
    public function render($templateName = null)
    {
        if (!$this->templatesDir) {
            throw new \RuntimeException('Set path to templates');
        }

        if ($templateName) {
            $this->templateName = $templateName;
        }

        if (!$this->templateName) {
            throw new \RuntimeException('Set template name');
        }

        $templatePath = $this->templatesDir . DS . $this->templateName;

        if (!file_exists($templatePath) && !is_readable($templatePath)) {
            throw new \RuntimeException('Template ' . $templatePath . ' not found');
        }

        ob_start();

        try {
            include $templatePath;
        }
        catch (\Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ob_get_clean();
    }

    /**
     * Render file and return content (view helper. use it in templates)
     *
     * @param $file
     * @param array $data
     * @return string
     */
    public function partial($file, array $data = [])
    {
        $view = new self($this->templatesDir);
        $view->set($this->_);
        $view->set($data);
        $templateName = 'partials' . DS . $file . '.phtml';
        return $view->render($templateName);
    }

    /**
     * Safe output
     *
     * @param $string
     * @throws \Exception
     * @return string
     */
    public function escape($string)
    {
        $string = (string) $string;
        return htmlspecialchars($string, ENT_QUOTES);
    }

    /**
     * @param $string
     * @return mixed
     */
    public function localize($string)
    {
        return I18n::getInstance()->get($string);
    }

    /**
     * Create link with language section
     *
     * @param string $url Must begin from /
     * @return string
     */
    public function langUrl($url)
    {
        return '/' . I18n::getInstance()->getLang() . $url;
    }
}