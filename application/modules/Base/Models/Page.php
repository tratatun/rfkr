<?php

namespace Base\Models;

use Base\Config;
use Base\Db;
use Base\Exception;

/**
 * Class Page
 *
 * @package Models
 */
class Page {

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
     *
     */
    public function getAll() {
        $data = $this->_db->query('SELECT id, name, title, title_en FROM pages')->fetchAll();

        foreach ($data as $key => $item) {
            if (in_array($item['name'], ['404'])) {
                unset($data[$key]);
            }
        }

        return $data;
    }

    public function savePage($data)
    {
        $sql = "UPDATE pages SET "
            . " meta_description = '" . $this->_db->escape($data['meta_description']) . "', "
            . " meta_description_en = '" . $this->_db->escape($data['meta_description_en']) . "', "
            . " meta_keywords = '" . $this->_db->escape($data['meta_keywords']) . "', "
            . " meta_keywords_en = '" . $this->_db->escape($data['meta_keywords_en']) . "', "
            . " preview = '" . $this->_db->escape($data['preview']) . "', "
            . " preview_en = '" . $this->_db->escape($data['preview_en']) . "', "
            . " page_title = '" . $this->_db->escape($data['page_title']) . "', "
            . " page_title_en = '" . $this->_db->escape($data['page_title_en']) . "', "
            . " title = '" . $this->_db->escape($data['title']) . "', "
            . " title_en = '" . $this->_db->escape($data['title_en']) . "', "
            . " text = '" . $this->_db->escape($data['text']) . "', "
            . " text_en = '" . $this->_db->escape($data['text_en']) . "' "
            . "WHERE id = " . $this->_db->escape($data['id']);

        $this->_db->query($sql)->exec();
    }

    /**
     * @param int $id
     */
    public function deleteById($id)
    {
        $this->_db->query("DELETE FROM pages WHERE id = $id")->exec();
    }

    /**
     *
     *
     * @param int $id
     * @return array
     */
    public function getPageById($id) {
        return $this->_db->query("SELECT * FROM pages WHERE id = $id")->fetchRow();
    }

    /**
     * Return page data by specified page name and lang
     *
     * @param string $page
     * @param string $lang
     * @throws Exception
     * @return array
     */
    public function getData($page, $lang) {
        $data = $this->_db->query('SELECT * FROM pages WHERE name = "'. $page .'"')->fetchRow();
        if (!$data) {
            return [
                'id' => '',
                'name' => '',
                'metaDescription' => '',
                'metaKeywords' => '',
                'preview' => '',
                'pageTitle' => '',
                'title' => '',
                'text' => ''
            ];
        }
        if ($lang == 'en') {
            return [
                'id' => $data['id'],
                'name' => $data['name'],
                'metaDescription' => $data['meta_description_en'],
                'metaKeywords' => $data['meta_keywords_en'],
                'preview' => $data['preview_en'],
                'pageTitle' => $data['page_title_en'],
                'title' => $data['title_en'],
                'text' => nl2br($data['text_en'])
            ];
        } else {
            return [
                'id' => $data['id'],
                'name' => $data['name'],
                'metaDescription' => $data['meta_description'],
                'metaKeywords' => $data['meta_keywords'],
                'preview' => $data['preview'],
                'pageTitle' => $data['page_title'],
                'title' => $data['title'],
                'text' => nl2br($data['text'])
            ];
        }
    }
}