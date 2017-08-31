<?php

namespace Base\Core\Router\Route;

/**
 * Route
 *
 * @package    Base\Core
 * @subpackage Router
 */
class Route extends RouteAbstract
{
    protected $urlVariable = ':';
    protected $urlDelimiter = self::URI_DELIMITER;
    protected $regexDelimiter = '#';
    protected $defaultRegex = null;

    /**
     * Holds names of all route's pattern variable names. Array index holds a position in URL.
     * @var array
     */
    protected $variables = [];

    /**
     * Holds Route patterns for all URL parts. In case of a variable it stores it's regex
     * requirement or null. In case of a static part, it holds only it's direct value.
     * In case of a wildcard, it stores an asterisk (*)
     * @var array
     */
    protected $parts = [];

    /**
     * Holds user submitted default values for route's variables. Name and value pairs.
     * @var array
     */
    protected $defaults = [];

    /**
     * Holds user submitted regular expression patterns for route's variables' values.
     * Name and value pairs.
     * @var array
     */
    protected $requirements = [];

    /**
     * Associative array filled on match() that holds matched path values
     * for given variable names.
     * @var array
     */
    protected $values = [];

    /**
     * Associative array filled on match() that holds wildcard variable
     * names and values.
     * @var array
     */
    protected $wildcardData = [];

    /**
     * Helper var that holds a count of route pattern's static parts
     * for validation
     * @var int
     */
    protected $staticCount = 0;

    /**
     * Prepares the route for mapping by splitting (exploding) it
     * to a corresponding atomic parts. These parts are assigned
     * a position which is later used for matching and preparing values.
     *
     * @param string $route Map used to match with later submitted URL path
     * @param array $defaults Defaults for map variables with keys as variable names
     * @param array $reqs Regular expression requirements for variables (keys as variable names)
     */
    public function __construct($route, $defaults = [], $reqs = [])
    {
        $route               = trim($route, $this->urlDelimiter);
        $this->defaults     = (array) $defaults;
        $this->requirements = (array) $reqs;

        if ($route !== '') {
            foreach (explode($this->urlDelimiter, $route) as $pos => $part) {
                if (substr($part, 0, 1) == $this->urlVariable && substr($part, 1, 1) != $this->urlVariable) {
                    $name = substr($part, 1);

                    if (substr($name, 0, 1) === '@' && substr($name, 1, 1) !== '@') {
                        $name = substr($name, 1);
                    }

                    $this->parts[$pos]     = (isset($reqs[$name]) ? $reqs[$name] : $this->defaultRegex);
                    $this->variables[$pos] = $name;
                } else {
                    if (substr($part, 0, 1) == $this->urlVariable) {
                        $part = substr($part, 1);
                    }

                    if (substr($part, 0, 1) === '@' && substr($part, 1, 1) !== '@') {
                        $this->_isTranslated = true;
                    }

                    $this->parts[$pos] = $part;

                    if ($part !== '*') {
                        $this->staticCount++;
                    }
                }
            }
        }
    }

    /**
     * Matches a user submitted path with parts defined by a map. Assigns and
     * returns an array of variables on a successful match.
     *
     * @param string $path Path used to match against this routing map
     * @return array|false An array of assigned values or a false on a mismatch
     */
    public function match($path, $partial = false)
    {
        $pathStaticCount = 0;
        $values          = [];
        $matchedPath     = '';

        if (!$partial) {
            $path = trim($path, $this->urlDelimiter);
        }

        if ($path !== '') {
            $path = explode($this->urlDelimiter, $path);

            foreach ($path as $pos => $pathPart) {
                // Path is longer than a route, it's not a match
                if (!array_key_exists($pos, $this->parts)) {
                    if ($partial) {
                        break;
                    } else {
                        return false;
                    }
                }

                $matchedPath .= $pathPart . $this->urlDelimiter;

                // If it's a wildcard, get the rest of URL as wildcard data and stop matching
                if ($this->parts[$pos] == '*') {
                    $count = count($path);
                    for($i = $pos; $i < $count; $i+=2) {
                        $var = urldecode($path[$i]);
                        if (!isset($this->wildcardData[$var]) && !isset($this->defaults[$var]) && !isset($values[$var])) {
                            $this->wildcardData[$var] = (isset($path[$i+1])) ? urldecode($path[$i+1]) : null;
                        }
                    }

                    $matchedPath = implode($this->urlDelimiter, $path);
                    break;
                }

                $name     = isset($this->variables[$pos]) ? $this->variables[$pos] : null;
                $pathPart = urldecode($pathPart);

                // Translate value if required
                $part = $this->parts[$pos];

                if (substr($part, 0, 2) === '@@') {
                    $part = substr($part, 1);
                }

                // If it's a static part, match directly
                if ($name === null && $part != $pathPart) {
                    return false;
                }

                // If it's a variable with requirement, match a regex. If not - everything matches
                if ($part !== null && !preg_match($this->regexDelimiter . '^' . $part . '$' . $this->regexDelimiter . 'iu', $pathPart)) {
                    return false;
                }

                // If it's a variable store it's value for later
                if ($name !== null) {
                    $values[$name] = $pathPart;
                } else {
                    $pathStaticCount++;
                }
            }
        }

        // Check if all static mappings have been matched
        if ($this->staticCount != $pathStaticCount) {
            return false;
        }

        $return = $values + $this->wildcardData + $this->defaults;

        // Check if all map variables have been initialized
        foreach ($this->variables as $var) {
            if (!array_key_exists($var, $return)) {
                return false;
            } elseif ($return[$var] == '' || $return[$var] === null) {
                // Empty variable? Replace with the default value.
                $return[$var] = $this->defaults[$var];
            }
        }

        $this->setMatchedPath(rtrim($matchedPath, $this->urlDelimiter));

        $this->values = $values;

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
        return null;
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
        return $this->variables;
    }
}
