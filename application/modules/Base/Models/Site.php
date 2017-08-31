<?php

namespace Base\Models;

use Base\Db;
use Base\Config;

class Site {

    protected $_db;

    /**
     *
     */
    public function __construct() {

        $this->_db = new Db(Config::get('application')['db']);
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->_db->query('SELECT * FROM site')->fetchRow();
    }

    /**
     * @param $data
     */
    public function save($data) {

        $sql = "UPDATE site SET ";
        $parts = [];

        foreach ($data as $key => $val) {
            $parts[] = $key . " = " . "'" . $this->_db->escape($val) . "'";
        }

        $sql .= implode(', ', $parts);
        $this->_db->query($sql)->exec();
    }
}