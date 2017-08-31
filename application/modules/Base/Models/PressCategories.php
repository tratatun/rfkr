<?php

namespace Base\Models;

use Base\Config;
use Base\Db;
use Base\Exception;

/**
 * Class DesignCategories
 *
 * @package Models
 */
class PressCategories {

    /**
     * @var Db
     */
    protected $_db;

    const MAX_COUNT_IMAGES = 5;

    CONST MIN_IMAGE_WIDTH = 1100;

    /**
     *
     */
    public function __construct() {

        $this->_db = new Db(Config::get('application')['db']);
    }

    public function getSelect() {
        $items = $this->_db->query('SELECT id, title FROM press_category')->fetchAll();
        $data = [];
        foreach ($items as $item) {
            $data[$item['id']] = $item['title'];
        }
        return $data;
    }

    /**
     *
     * @param string $lang
     * @throws Exception
     * @return array
     */
    public function getData($lang) {
        $items = $this->_db->query('SELECT * FROM press_category WHERE status = 1')->fetchAll();

        $data = [];
        
        foreach ($items as $key => $item) {
            $data[$key]['id'] = $item['id'];
            $data[$key]['url'] = $item['url'];

            if ($lang == 'en') {
                $data[$key]['title'] = $item['title_en'];
                $data[$key]['page_title'] = $item['page_title_en'];
                $data[$key]['h1'] = $item['h1_en'];
                $data[$key]['meta_keywords'] = $item['meta_keywords_en'];
                $data[$key]['meta_description'] = $item['meta_description_en'];
                $data[$key]['text'] = nl2br($item['text_en']);
            } else {
                $data[$key]['title'] = $item['title'];
                $data[$key]['page_title'] = $item['page_title'];
                $data[$key]['h1'] = $item['h1'];
                $data[$key]['meta_keywords'] = $item['meta_keywords'];
                $data[$key]['meta_description'] = $item['meta_description'];
                $data[$key]['text'] = nl2br($item['text']);
            }
        }
        return $data;
    }
    
    

    /**
     * @param $data
     */
    public function save($data) {
        $status = (isset($data['status']) && $data['status'] == '1') ? 1 : 0;
        
        $sql = "UPDATE press_category SET "
            . " url = '" . $this->_db->escape($data['url']) . "', "
            . " status = " . $status . ", "
            . " title = '" . $this->_db->escape($data['title']) . "', "
            . " title_en = '" . $this->_db->escape($data['title_en']) . "', "
            . " page_title = '" . $this->_db->escape($data['page_title']) . "', "
            . " page_title_en = '" . $this->_db->escape($data['page_title_en']) . "', "
            . " h1 = '" . $this->_db->escape($data['h1']) . "', "
            . " h1_en = '" . $this->_db->escape($data['h1_en']) . "', "            
            . " meta_keywords = '" . $this->_db->escape($data['meta_keywords']) . "', "
            . " meta_description = '" . $this->_db->escape($data['meta_description']) . "', "
            . " meta_keywords_en = '" . $this->_db->escape($data['meta_keywords_en']) . "', "
            . " meta_description_en = '" . $this->_db->escape($data['meta_description_en']) . "', "
            . " text = '" . $this->_db->escape($data['text']) . "', "
            . " text_en = '" . $this->_db->escape($data['text_en']) . "' "            
            . " WHERE id = " . $data['id'];
        
        $this->_db->query($sql)->exec();
    }

    /**
     * @return int
     */
    public function createItem()
    {
        $sql = "INSERT INTO press_category (url, status, title, title_en, page_title, dpage_title_en, h1, h1_en, meta_keywords, meta_description, meta_keywords_en, meta_description_en, text, text_en) VALUES ('',  0, 'Заголовок', 'Title', 'Page Title', 'Page Title', 'H1 Title', 'H1 Title', '', '', '', '')";
        $this->_db->query($sql)->exec();
        return $this->_db->getGeneratedId();
    }

    public function deleteById($id)
    {      
        $this->_db->query("DELETE FROM press_category WHERE id = $id")->exec();
    }


    /**
     * @param $id
     * @return array
     */
    public function getById($id) {

        $data = $this->_db->query("SELECT * FROM press_category WHERE id = $id")->fetchRow();
        $data['images'] = "";
    
        return $data;
    }

    /**
    * @param $id
    * @return array
    */
    public function getByIdAndLang($id, $lang) {

        $category = $this->_db->query("SELECT * FROM press_category WHERE url = '$id'")->fetchRow();

        $data['id'] = $category['id'];

        if ($lang == 'en') {
            $data['title'] = $category['title_en'];
            $data['page_title'] = $category['page_title_en'];
            $data['h1'] = $category['h1_en'];            
            $data['meta_keywords'] = $category['meta_keywords_en'];
            $data['meta_description'] = $category['meta_description_en'];
            $data['text'] = $category['text_en'];
        } else {
            $data['title'] = $category['title'];
            $data['page_title'] = $category['page_title'];
            $data['h1'] = $category['h1'];
            $data['meta_keywords'] = $category['meta_keywords'];
            $data['meta_description'] = $category['meta_description'];
            $data['text'] = $category['text'];
        }

        return $data;
    }

    /**
     * @return array
     */
    public function getAll() {

        $items = $this->_db->query('SELECT * FROM press_category')->fetchAll();

        foreach ($items as &$item) {
            $item['canDelete'] = $this->canBeDeleted($item['id']);
        }

        return $items;
    }

    public function canBeDeleted($id) {
        $res = $this->_db->query('SELECT * FROM press WHERE category = ' . $id)->fetchAll();
        return ! (bool) count($res);
    }


}