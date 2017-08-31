<?php

namespace Base\Models;

use Base\Config;
use Base\Db;

/**
 * Class Menu
 *
 * @package Models
 */
class Menu {

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
     * @param string $currentPageName
     * @param string $lang
     * @return array
     */

    public function getMain($currentPageName = 'index', $lang = 'en')
    {
        $menu = $this->_db->query('SELECT * FROM menu WHERE lang = "' . $lang . '"')->fetchAll();

        $_menu = [];

        foreach ($menu as $value) {
            $_menu[$value['name']] = $value;
            if ($value['name'] == $currentPageName) {
                $_menu[$value['name']]['isActive'] = true;
            } else {
                $_menu[$value['name']]['isActive'] = false;
            }

            if ($value['name'] == 'press'
                && (in_array($currentPageName, ['pressitem', 'press']))
            ) {
                $_menu[$value['name']]['isActive'] = true;
            }            
            
            if ($value['name'] == 'design'
                && (in_array($currentPageName, ['projects', 'project']))
            ) {
                $_menu[$value['name']]['isActive'] = true;
            }
        }

        return $_menu;
    }

    /**
     * @param string $lang
     * @return array
     */
    public function getFooter($lang = 'en')
    {
        $menu = $this->_db->query('SELECT * FROM menu WHERE lang = "' . $lang . '"')->fetchAll();
        $_menu = [];

        foreach ($menu as $item) {
            $_menu[$item['name']] = $item;
        }
        return $_menu;
    }

    /**
     * @return array
     */
    public function getAllGroupByLang()
    {
        return [
            'en' => $this->_db->query("SELECT * FROM menu WHERE lang = 'en'")->fetchAll(),
            'ru' => $this->_db->query("SELECT * FROM menu WHERE lang = 'ru'")->fetchAll(),
        ];
    }

    /**
     * @param $data
     */
    public function save($data) {

        $sql = "UPDATE menu SET ";
        $parts = [];

        foreach ($data as $key => $val) {
            $this->_db->query($sql . "title = '" . $this->_db->escape($val) . "' WHERE id = {$key}")->exec();
        }

    }
}