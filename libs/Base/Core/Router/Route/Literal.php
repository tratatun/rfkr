<?php

namespace Base\Core\Router\Route;

/**
 * Literal is used for managing static URIs.
 *
 * It's a lot faster compared to the standard Route implementation.
 */
class Literal extends RouteAbstract
{

    protected $route = null;
    protected $defaults = [];

    /**
     * Prepares the route for mapping.
     *
     * @param string $route Map used to match with later submitted URL path
     * @param array $defaults Defaults for map variables with keys as variable names
     */
    public function __construct($route, $defaults = [])
    {
        $this->route = trim($route, self::URI_DELIMITER);
        $this->defaults = (array) $defaults;
    }

    /**
     * Matches a user submitted path with a previously defined route.
     * Assigns and returns an array of defaults on a successful match.
     *
     * @param string $path Path used to match against this routing map
     * @return array|false An array of assigned values or a false on a mismatch
     */
    public function match($path, $partial = false)
    {
        if ($partial) {
            if ((empty($path) && empty($this->route))
                || (substr($path, 0, strlen($this->route)) === $this->route)
            ) {
                $this->setMatchedPath($this->route);
                return $this->defaults;
            }
        } else {
            if (trim($path, self::URI_DELIMITER) == $this->route) {
                return $this->defaults;
            }
        }

        return false;
    }

    /**
     * Return a single parameter of route's defaults
     *
     * @param string $name Array key of the parameter
     * @return string Previously set default
     */
    public function getDefault($name) {
        if (isset($this->defaults[$name])) {
            return $this->defaults[$name];
        }
        return null;
    }

    /**
     * Return an array of defaults
     *
     * @return array Route defaults
     */
    public function getDefaults() {
        return $this->defaults;
    }

}
