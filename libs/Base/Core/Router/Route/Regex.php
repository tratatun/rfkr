<?php

namespace Base\Core\Router\Route;

/**
 * Class Regex
 *
 * @package Base\Core\Router\Route
 */
class Regex extends RouteAbstract
{
    protected $regex = null;
    protected $defaults = [];
    protected $reverse = null;
    protected $map = [];
    protected $values = [];

    public function __construct($route, $defaults = [], $map = [], $reverse = null)
    {
        $this->regex    = $route;
        $this->defaults = (array) $defaults;
        $this->map      = (array) $map;
        $this->reverse  = $reverse;
    }

    /**
     * Matches a user submitted path with a previously defined route.
     * Assigns and returns an array of defaults on a successful match.
     *
     * @param  string $path Path used to match against this routing map
     * @return array|false  An array of assigned values or a false on a mismatch
     */
    public function match($path, $partial = false)
    {
        if (!$partial) {
            $path = trim(urldecode($path), self::URI_DELIMITER);
            $regex = '#^' . $this->regex . '$#i';
        } else {
            $regex = '#^' . $this->regex . '#i';
        }

        $res = preg_match($regex, $path, $values);

        if ($res === 0) {
            return false;
        }

        if ($partial) {
            $this->setMatchedPath($values[0]);
        }

        // array_filter_key()? Why isn't this in a standard PHP function set yet? :)
        foreach ($values as $i => $value) {
            if (!is_int($i) || $i === 0) {
                unset($values[$i]);
            }
        }

        $this->values = $values;

        $values   = $this->getMappedValues($values);
        $defaults = $this->getMappedValues($this->defaults, false, true);
        $return   = $values + $defaults;

        return $return;
    }

    /**
     * Maps numerically indexed array values to it's associative mapped counterpart.
     * Or vice versa. Uses user provided map array which consists of index => name
     * parameter mapping. If map is not found, it returns original array.
     *
     * Method strips destination type of keys form source array. Ie. if source array is
     * indexed numerically then every associative key will be stripped. Vice versa if reversed
     * is set to true.
     *
     * @param  array   $values Indexed or associative array of values to map
     * @param  boolean $reversed False means translation of index to association. True means reverse.
     * @param  boolean $preserve Should wrong type of keys be preserved or stripped.
     * @return array   An array of mapped values
     */
    protected function getMappedValues($values, $reversed = false, $preserve = false)
    {
        if (count($this->map) == 0) {
            return $values;
        }

        $return = [];

        foreach ($values as $key => $value) {
            if (is_int($key) && !$reversed) {
                if (array_key_exists($key, $this->map)) {
                    $index = $this->map[$key];
                } elseif (false === ($index = array_search($key, $this->map))) {
                    $index = $key;
                }
                $return[$index] = $values[$key];
            } elseif ($reversed) {
                $index = $key;
                if (!is_int($key)) {
                    if (array_key_exists($key, $this->map)) {
                        $index = $this->map[$key];
                    } else {
                        $index = array_search($key, $this->map, true);
                    }
                }
                if (false !== $index) {
                    $return[$index] = $values[$key];
                }
            } elseif ($preserve) {
                $return[$key] = $value;
            }
        }

        return $return;
    }

    /**
     * Return a single parameter of route's defaults
     *
     * @param string $name Array key of the parameter
     * @return string Previously set default
     */
    public function getDefault($name)
    {
        if (isset($this->defaults[$name])) {
            return $this->defaults[$name];
        }
    }

    /**
     * Return an array of defaults
     *
     * @return array Route defaults
     */
    public function getDefaults()
    {
        return $this->defaults;
    }

    /**
     * Get all variables which are used by the route
     *
     * @return array
     */
    public function getVariables()
    {
        $variables = [];

        foreach ($this->map as $key => $value) {
            if (is_numeric($key)) {
                $variables[] = $value;
            } else {
                $variables[] = $key;
            }
        }

        return $variables;
    }

    /**
     * arrayMergeNumericKeys() - allows for a strict key (numeric's included) array_merge.
     * php's array_merge() lacks the ability to merge with numeric keys.
     *
     * @param array $array1
     * @param array $array2
     * @return array
     */
    protected function arrayMergeNumericKeys(Array $array1, Array $array2)
    {
        $returnArray = $array1;
        foreach ($array2 as $array2Index => $array2Value) {
            $returnArray[$array2Index] = $array2Value;
        }
        return $returnArray;
    }


}
