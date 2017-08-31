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
class DesignCategories {

    /**
     * @var Db
     */
    protected $_db;

    const MAX_COUNT_IMAGES = 5;

    CONST MIN_IMAGE_WIDTH = 1100;

    public static $images = [
        'org' => [
            'name' => 'category_org_item_',
            'db_column' => 'file_name_org'
        ],
        'desc' => [
            'name' => 'category_desc_item_',
            'db_column' => 'file_name_des',
            'width' => 1328,
            'height' => 736
        ],
        'mobile' => [
            'name' => 'category_mob_item_',
            'db_column' => 'file_name_mob',
            'width' => 664,
            'height' => 368
        ],
        'thumb' => [
            'name' => 'category_thumb_item_',
            'db_column' => 'file_name_tmb',
            'width' => 166,
            'height' => 92
        ],
    ];

    /**
     *
     */
    public function __construct() {

        $this->_db = new Db(Config::get('application')['db']);
    }

    public function getSelect() {
        $items = $this->_db->query('SELECT id, title FROM interiors')->fetchAll();
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
        $items = $this->_db->query('SELECT * FROM interiors WHERE status = 1 ORDER BY sortorder ASC')->fetchAll();

        $data = [];
        
        foreach ($items as $key => $item) {
            $data[$key]['id'] = $item['id'];
            $data[$key]['url'] = $item['url'];
            $data[$key]['sortorder'] = $item['sortorder'];

            if ($lang == 'en') {
                $data[$key]['title'] = $item['title_en'];
                $data[$key]['meta_keywords'] = $item['meta_keywords_en'];
                $data[$key]['meta_description'] = $item['meta_description_en'];
                $data[$key]['description'] = nl2br($item['description_en']);
                $data[$key]['text'] = nl2br($item['text_en']);
            } else {
                $data[$key]['title'] = $item['title'];
                $data[$key]['meta_keywords'] = $item['meta_keywords'];
                $data[$key]['meta_description'] = $item['meta_description'];
                $data[$key]['description'] = nl2br($item['description']);
                $data[$key]['text'] = nl2br($item['text']);
            }

            $images = $this->_db->query('SELECT * FROM interior_images WHERE interior_id = ' . $item['id'])->fetchAll();

            foreach ($images as $image) {
                $data[$key]['images'][]['path'] = Helper::getImagePath($image['file_name_des']);
            }

        }
        

        return $data;
    }

    /**
     * @param $data
     */
    public function save($data) {

        $status = (isset($data['status']) && $data['status'] == '1') ? 1 : 0;

        $sql = "UPDATE interiors SET "
            . " sortorder = " . $this->_db->escape($data['sortorder']) . ", "
            . " status = " . $status . ", "
            . " meta_keywords = '" . $this->_db->escape($data['meta_keywords']) . "', "
            . " meta_description = '" . $this->_db->escape($data['meta_description']) . "', "
            . " meta_keywords_en = '" . $this->_db->escape($data['meta_keywords_en']) . "', "
            . " meta_description_en = '" . $this->_db->escape($data['meta_description_en']) . "', "
            . " title = '" . $this->_db->escape($data['title']) . "', "
            . " title_en = '" . $this->_db->escape($data['title_en']) . "', "
            . " text = '" . $this->_db->escape($data['text']) . "', "
            . " text_en = '" . $this->_db->escape($data['text_en']) . "', "
            . " url = '" . $this->_db->escape($data['url']) . "', "
            . " description = '" . $this->_db->escape($data['description']) . "', "
            . " description_en = '" . $this->_db->escape($data['description_en']) . "' "
            . " WHERE id = " . $data['id'];

        $this->_db->query($sql)->exec();
    }

    /**
     * @return int
     */
    public function createItem()
    {
        $sql = "INSERT INTO interiors (sortorder, meta_description, meta_keywords, meta_description_en, meta_keywords_en, status, title, title_en, description, description_en, text, text_en) VALUES (1, '', '', '', '', 0, 'Заголовок', 'Title', 'Описание', 'Description', '', '')";
        $this->_db->query($sql)->exec();
        return $this->_db->getGeneratedId();
    }

    public function deleteById($id)
    {
        $list = $this->_db->query("SELECT file_name_org, file_name_des, file_name_mob, file_name_tmb FROM interior_images WHERE interior_id = $id")->fetchAll();

        foreach ($list as $data) {
            foreach ($data as $image) {
                if (!empty($image)) {
                    unlink(Helper::getRootImagePath($image));
                }
            }
        }

        $this->_db->query("DELETE FROM interior_images WHERE interior_id = $id")->exec();
        $this->_db->query("DELETE FROM interiors WHERE id = $id")->exec();
    }

    /**
     * @param $data
     */
    public function addImage($data)
    {
        $sql = "INSERT INTO interior_images (interior_id, file_name_org, file_name_des, file_name_mob, file_name_tmb) "
            . " VALUES ("
            . "'" . $data['interior_id'] . "' ,"
            . "'" . $data['file_name_org'] . "', "
            . "'" . $data['file_name_des'] . "', "
            . "'" . $data['file_name_mob'] . "', "
            . "'" . $data['file_name_tmb'] . "'"
            . ")";
        $this->_db->query($sql)->exec();
    }

    /**
     * @param $id
     * @return array
     */
    public function getById($id) {

        $data = $this->_db->query("SELECT * FROM interiors WHERE id = $id")->fetchRow();

        $images = $this->_db->query("SELECT * FROM interior_images WHERE interior_id = $id")->fetchAll();

        foreach ($images as &$image) {
            $image['file_name_org'] = Helper::getImagePath($image['file_name_org']);
            $image['file_name_des'] = Helper::getImagePath($image['file_name_des']);
            $image['file_name_mob'] = Helper::getImagePath($image['file_name_mob']);
        }

        $data['images'] = $images;

        return $data;
    }

    /**
    * @param $id
    * @return array
    */
    public function getByIdAndLang($id, $lang) {

        $category = $this->_db->query("SELECT * FROM interiors WHERE url = '$id'")->fetchRow();

        $data['id'] = $category['id'];

        if ($lang == 'en') {
            $data['title'] = $category['title_en'];
            $data['meta_keywords'] = $category['meta_keywords_en'];
            $data['meta_description'] = $category['meta_description_en'];
            $data['text'] = $category['text_en'];
        } else {
            $data['title'] = $category['title'];
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

        $items = $this->_db->query('SELECT * FROM interiors')->fetchAll();

        foreach ($items as &$item) {
            $res = $this->_db->query('SELECT * FROM projects WHERE category = ' . $item['id'])->fetchAll();
            $item['canDelete'] = $this->canBeDeleted($item['id']);
        }

        return $items;
    }

    public function canBeDeleted($id) {
        $res = $this->_db->query('SELECT * FROM projects WHERE category = ' . $id)->fetchAll();
        return ! (bool) count($res);
    }

    /**
     * @param $id
     */
    public function deleteImage($id) {

        $data = $this->_db->query("SELECT file_name_org, file_name_des, file_name_mob, file_name_tmb FROM interior_images WHERE id = $id")->fetchRow();
        $this->_db->query("DELETE FROM interior_images WHERE id = $id")->exec();

        foreach ($data as $item) {
            unlink(Helper::getRootImagePath($item));
        }

    }
}