<?php

namespace Base;

/**
 * Class SingletonTrait
 *
 * @package classes
 */
trait SingletonTrait {
    /**
     * Singleton pattern implementation makes "new" unavailable
     */
    protected function __construct() {}

    /**
     * Singleton pattern implementation makes "clone" unavailable
     */
    protected function __clone() {}
}