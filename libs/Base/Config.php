<?php

namespace Base;

/**
 * Class for work with configuration files
 *
 * @package Base
 * @author Eugene Orekhov
 */
class Config
{
    /**
     * @var string Path to directory with config
     */
    protected static $directory;

    /**
     * @var array cached config
     */
    protected static $cache = [];

    /**
     * Retrieve configuration data from specified
     * file name
     *
     * @param $fileName
     * @return array
     */
    public static function get($fileName)
    {
        $fileName = strtolower($fileName);

        if (isset(self::$cache[$fileName])) {
            return self::$cache[$fileName];
        }

        if (!self::$directory) {
            throw new \InvalidArgumentException('Config path is not defined. It must be defined.');
        }
        $filePath = self::$directory . $fileName . '.php';

        if (!file_exists($filePath)) {
            throw new \RuntimeException('Configuration file ' . $fileName . ' does not exist');
        }

        $data = require $filePath;
        self::$cache[$fileName] = $data;
        return $data;
    }

    /**
     * @param $directory
     */
    public static function setDirectory($directory)
    {
        self::$directory = self::normalizeDirectory($directory);
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
}