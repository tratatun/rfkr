<?php

namespace Base;

/**
 * Class for work with MySQL database
 *
 * @package Base
 * @author Eugene Orekhov <oeswww@gmail.com>
 */
class Db
{
    /**
     * MySQL link identifier on success or false on failure.
     *
     * @var \mysqli
     */
    private $resource;

    /**
     * SQL query string
     *
     * @var string
     */
    private $query;

    /**
     * Resource For SELECT, SHOW, DESCRIBE, EXPLAIN and other statements returning resultset.
     *
     * @var \mysqli_result
     */
    private $response;

    /**
     * Database host
     *
     * @var string
     */
    private $host;

    /**
     * Database user
     *
     * @var
     */
    private $user;

    /**
     * Database password
     *
     * @var
     */
    private $password;

    /**
     * Database name
     *
     * @var
     */
    private $database;

    /**
     * Initialize database connection
     *
     * @param array $parameters Database parameters
     * @throws \InvalidArgumentException
     */
    public function __construct($parameters)
    {
        if (!isset($parameters['host'])) {
            throw new \InvalidArgumentException('Parameter "host" is required.');
        }

        if (!isset($parameters['user'])) {
            throw new \InvalidArgumentException('Parameter "user" is required.');
        }

        if (!isset($parameters['password'])) {
            throw new \InvalidArgumentException('Parameter "password" is required.');
        }

        if (!isset($parameters['database'])) {
            throw new \InvalidArgumentException('Parameter "database" is required.');
        }

        $this->host = $parameters['host'];
        $this->user = $parameters['user'];
        $this->password = $parameters['password'];
        $this->database = $parameters['database'];

        $this->connect();
    }

    /**
     * Set sql query string
     *
     * @param string $query
     * @return $this
     * @return $this
     */
    public function query($query)
    {
        $this->query = $query;
        return $this;
    }

    /**
     * Execute a query
     */
    public function exec()
    {
        $this->queryExec();
        $this->reset();
    }

    /**
     * Fetch a result row
     *
     * @return array
     */
    public function fetchRow()
    {
        $this->queryExec();
        $data = mysqli_fetch_array($this->response, MYSQL_ASSOC);
        $this->reset();
        return $data;
    }

    /**
     * Retrieve all rows data of the query result.
     *
     * @return array
     */
    public function fetchAll()
    {
        $this->queryExec();
        $data = [];

        while ($row = mysqli_fetch_array($this->response, MYSQL_ASSOC)) {
            $data[] = $row;
        }

        $this->reset();
        return $data;
    }

    /**
     * Get number of affected rows in previous MySQL operation
     *
     * @return int
     */
    public function getAffectedRows()
    {
        return mysqli_affected_rows($this->resource);
    }

    /**
     * Return last generated id
     *
     * @return int
     */
    public function getGeneratedId()
    {
        return mysqli_insert_id($this->resource);
    }

    /**
     * Returns the text of the error message from previous MySQL operation
     *
     * @return string
     */
    public function getError()
    {
        return mysqli_error($this->resource);
    }

    /**
     * Returns the numerical value of the error message from previous MySQL operation
     * @return int
     */
    public function getErrno()
    {
        return mysqli_errno($this->resource);
    }

    /**
     * Execute a query
     *
     * @throws \InvalidArgumentException
     */
    private function queryExec()
    {
        if (is_null($this->query)) {
            throw new \InvalidArgumentException('Query string is empty');
        }
        $response = $this->resource->query($this->query);

        if ($response === false) {
            throw new \InvalidArgumentException('Db query error: ' . $this->getErrno() . ': ' . $this->getError());
        }

        $this->response = $response;
    }

    /**
     * @param $string
     * @return string
     */
    public function escape($string)
    {
        return mysqli_real_escape_string($this->resource, $string);
    }

    /**
     * Reset query statement and query result resource
     */
    private function reset()
    {
        $this->query = null;
        $this->response = null;
    }

    /**
     * Set databases connection, some configuration
     * and select a database
     */
    private function connect()
    {
        $this->resource = mysqli_connect($this->host, $this->user, $this->password, $this->database);

        if (!$this->resource) {
            throw new \InvalidArgumentException('Database connection failed: ' . $this->resource->error);
        }

        $this->resource->query('SET NAMES utf8');
    }
}