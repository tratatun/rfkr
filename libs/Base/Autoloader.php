<?php

/**
 *
 * @category Base
 * @author Eugene Orekhov <oeswww@gmail.com>
 */

namespace Base;

/**
 * Autoloader.
 *
 * Load classes. PSR-0 complaint autoloader.
 * Allow autoloading both namespaced and vendor-prefixed classes.
 * Supports other class load methods
 *
 * @category Base
 * @author Eugene Orekhov <oeswww@gmail.com>
 */
class Autoloader
{
    const NAMESPACE_SEPARATOR = '\\';
    const PREFIX_SEPARATOR = '_';
    const FILE_EXTENSION = '.php';

    /**
     * @var array List of include directories
     */
    protected static $directories = [];

    /**
     * Register an extra library directory
     *
     * @param string $path
     */
    public static function registerDirectory($path)
    {
        if (!in_array($path, self::$directories)) {
            self::$directories[] = self::normalizeDirectory($path);
        }
    }

    /**
     * Load class.
     *
     * @param $class
     * @return bool
     */
    public static function load($class)
    {
        // Fallback autoloading
        $filename = self::transformClassNameToFileName($class, '');
        $resolvedName = stream_resolve_include_path($filename);

        if ($resolvedName !== false) {
            require_once $resolvedName;
            return true;
        }

        foreach (self::$directories as $directory) {
            $filename = self::transformClassNameToFileName($class, $directory);
            if (is_file($filename)) {
                require_once $filename;
                return true;
            }
        }
        return false;
    }


    /**
     * Normalize directory
     *
     * @param string $directory
     * @return string
     */
    protected static function normalizeDirectory($directory)
    {
        $last = $directory[strlen($directory) - 1];
        if (in_array($last, ['/', '\\'])) {
            $directory[strlen($directory) -1] = DIRECTORY_SEPARATOR;
            return $directory;
        }
        return $directory . DIRECTORY_SEPARATOR;
    }

    /**
     * Transform class name to file name
     *
     * @param string $class
     * @param string $directory
     * @return string
     */
    protected static function transformClassNameToFileName($class, $directory)
    {
        // $class may contain a namespace portion, in  which case we need
        // to preserve any underscores in that portion.
        $matches = [];
        preg_match('/(?P<namespace>.+\\\)?(?P<class>[^\\\]+$)/', $class, $matches);

        $className = (isset($matches['class'])) ? $matches['class'] : '';
        $namespace = (isset($matches['namespace'])) ? $matches['namespace'] : '';

        return $directory . str_replace(self::NAMESPACE_SEPARATOR, DIRECTORY_SEPARATOR, $namespace) . str_replace(self::PREFIX_SEPARATOR, DIRECTORY_SEPARATOR, $className) . self::FILE_EXTENSION;
    }

    /**
     * Register class as class load function
     */
    public static function register()
    {
        spl_autoload_register(array('Base\Autoloader', 'load'), true);
    }
}
