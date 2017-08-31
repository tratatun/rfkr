<?php

namespace Base\Models;

use Base\Config;
use Base\Db;

/**
 * Class Services
 *
 * @package Models
 */
class Services {

    /**
     * @var Db
     */
    protected $_db;

    /**
     *
     */
    public function __construct() {

        $this->_db = new Db(Config::get('application')['db']);
    }

    /**
     * @param string $lang
     * @return array
     */
    public function getData($lang = 'en') {

        $columns = $this->_db->query('SELECT * FROM services')->fetchAll();
        $_columns = [];

        foreach ($columns as $column) {

            if ($lang == 'en') {
                $_columns[] = [
                    'title' => $column['step_title_en'],
                    'text' => $column['step_text_en'],
                ];
            } else {
                $_columns[] = [
                    'title' => $column['step_title'],
                    'text' => $column['step_text'],
                ];
            }
        }

        return $_columns;
    }

    public function getAll() {

        return $this->_db->query('SELECT * FROM services')->fetchAll();
    }

    public function save($data) {

        foreach ($data as $id => $item) {

            $id = (int) $id;

            $sql = "UPDATE services SET "
                . " step_title = '" . trim($this->_db->escape($item['step_title'])) . "', "
                . " step_title_en = '" . trim($this->_db->escape($item['step_title_en'])) . "', "
                . " step_text = '" . trim($this->_db->escape($item['step_text'])) . "', "
                . " step_text_en = '" . trim($this->_db->escape($item['step_text_en'])) . "' "
                . " WHERE id = " . $id
            ;
           $this->_db->query($sql)->exec();
        }
    }
}