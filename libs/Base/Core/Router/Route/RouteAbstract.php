<?php

namespace Base\Core\Router\Route;

/**
 * Abstract Route
 *
 * Implements interface and provides convenience methods
 */
abstract class RouteAbstract implements RouteInterface
{
    /**
     * URI delimiter
     */
    const URI_DELIMITER = '/';

    /**
     * Path matched by this route
     *
     * @var string
     */
    protected $matchedPath = null;

    /**
     * Set partially matched path
     *
     * @param  string $path
     * @return void
     */
    public function setMatchedPath($path)
    {
        $this->matchedPath = $path;
    }

    /**
     * Get partially matched path
     *
     * @return string
     */
    public function getMatchedPath()
    {
        return $this->matchedPath;
    }

    /**
     * Create a new chain
     *
     * @param  RouteInterface $route
     * @param  string $separator
     * @return Chain
     */
    public function chain(RouteInterface $route, $separator = '/')
    {
        $chain = new Chain();
        $chain->chain($this)->chain($route, $separator);

        return $chain;
    }
}
