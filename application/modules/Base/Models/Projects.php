<?php

namespace Base\Models;

use Base\Config;
use Base\Db;
use Base\Exception;
use Base\I18n;
use Zend\Mail\Exception\InvalidArgumentException;
use Zend\Mail\Exception\RuntimeException;

/**
 * Class Projects
 * @package Models
 */
class Projects {

    const MIN_IMAGE_WIDTH = 1300;

    const COUNT_ON_PAGE = 3;

    public static $images = [
        'org' => [
            'name' => 'project_org_item_',
            'db_column' => 'file_name_org'
        ],
        'desc' => [
            'name' => 'project_desc_item_',
            'db_column' => 'file_name_des',
            'width' => 1528,
            'height' => 848
        ],
        'mobile' => [
            'name' => 'project_mob_item_',
            'db_column' => 'file_name_mob',
            'width' => 764,
            'height' => 424
        ],
        'min_des' => [
            'name' => 'project_min_des_item_',
            'db_column' => 'file_name_min_des',
            'width' => 436,
            'height' => 424
        ],
        'min_des_mob' => [
            'name' => 'project_min_mob_item_',
            'db_column' => 'file_name_min_mob',
            'width' => 218,
            'height' => 212
        ],
    ];
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

    public function createItem()
    {
        $sql = "INSERT INTO projects (status, title, title_en, city, city_en, url, meta_description, meta_keywords, meta_description_en, meta_keywords_en) VALUES (0, 'Заголовок', 'Title', 'Город', 'City', 'project-" . time() . "', '', '', '', '')";
        $this->_db->query($sql)->exec();

        $id = $this->_db->getGeneratedId();

        for ($i = 0; $i < 4; $i++) {
            $sql = "INSERT INTO project_items (project_id, title, title_en, text, text_en) VALUES ({$id}, 'Заголовок', 'Title', 'Описание', 'Description')";
            $this->_db->query($sql)->exec();
        }

        return $id;
    }

    public function createImageItem($projectId)
    {
        $sql = "INSERT INTO project_items (project_id, title, title_en, text, text_en) VALUES ({$projectId}, 'Заголовок', 'Title', 'Описание', 'Description')";
        $this->_db->query($sql)->exec();
    }

    public function deleteImageItem($id)
    {
        $this->_db->query("DELETE FROM project_items WHERE id = $id")->exec();
    }

    public function deleteById($id)
    {
        $list = $this->_db->query("SELECT file_name_org, file_name_des, file_name_mob, file_name_min_des, file_name_min_mob FROM project_items WHERE project_id = $id")->fetchAll();

        foreach ($list as $data) {
            foreach ($data as $image) {
                if (!empty($image)) {
                    unlink(Helper::getRootImagePath($image));
                }
            }
        }

        $this->_db->query("DELETE FROM project_items WHERE project_id = $id")->exec();
        $this->_db->query("DELETE FROM projects WHERE id = $id")->exec();
    }

    /**
     *
     * @param string $lang
     * @param $page
     * @param $category
     * @return array
     */
    public function getData($lang, $page = 1, $category = null) {

        $sql = 'SELECT id FROM interiors WHERE url = "' . $category . '"';
        $result = $this->_db->query($sql)->fetchRow();

        if (is_null($result)) {
            throw new \RuntimeException('Category not found', 404);
        }

        $categoryId = (int) $result['id'];

        $sql = 'SELECT * FROM projects WHERE status = 1 AND category = ' . $categoryId;

        $sql .= ' ORDER BY id DESC LIMIT ' . ($page * self::COUNT_ON_PAGE - self::COUNT_ON_PAGE) . ' , ' . self::COUNT_ON_PAGE;

        $items = $this->_db->query($sql)->fetchAll();

        $sql = 'SELECT COUNT(id) as count FROM projects WHERE status = 1 AND category = ' . $categoryId;

        $count = $this->_db->query($sql)->fetchRow()['count'];
        $countPages = ceil($count / self::COUNT_ON_PAGE);
        $pages = [];

        for ($i = 1; $i <= $countPages; $i++) {
            $pages[$i] = '/' . I18n::getInstance()->getLang() . '/design/' . $category . '/page-' . $i;
        }

        $data = [];
        
        foreach ($items as $key => $item) {
            $data[$key]['id'] = $item['id'];
            $data[$key]['url'] = $item['url'];

            if ($lang == 'en') {
                $data[$key]['title'] = $item['title_en'];
                $data[$key]['city'] = $item['city_en'];
            } else {
                $data[$key]['title'] = $item['title'];
                $data[$key]['city'] = $item['city'];
            }

            $subItems = $this->_db->query('SELECT * FROM project_items WHERE project_id = ' . $item['id'])->fetchAll();
            $data[$key]['items'] = [];

            foreach ($subItems as $subItem) {
                if ($lang == 'en') {
                    $data[$key]['items'][] = [
                        'img_org' => Helper::getImagePath($subItem['file_name_org']),
                        'img_des' => Helper::getImagePath($subItem['file_name_des']),
                        'img_mob' => Helper::getImagePath($subItem['file_name_mob']),
                        'img_min_des' => Helper::getImagePath($subItem['file_name_min_des']),
                        'img_min_mob' => Helper::getImagePath($subItem['file_name_min_mob']),
                        'title' => $subItem['title_en'],
                        'text' => $subItem['text_en'],
                        'city' => $item['city_en']
                    ];
                } else {
                    $data[$key]['items'][] = [
                        'img_org' => Helper::getImagePath($subItem['file_name_org']),
                        'img_des' => Helper::getImagePath($subItem['file_name_des']),
                        'img_mob' => Helper::getImagePath($subItem['file_name_mob']),
                        'img_min_des' => Helper::getImagePath($subItem['file_name_min_des']),
                        'img_min_mob' => Helper::getImagePath($subItem['file_name_min_mob']),
                        'title' => $subItem['title'],
                        'text' => $subItem['text'],
                        'city' => $item['city']
                    ];
                }
            }

        }
        return [
            'data' => $data,
            'pages' => $pages
        ];
    }

    /**
     * @return array
     */
    public function getList()
    {
        return $this->_db->query('SELECT * FROM projects ORDER BY id DESC')->fetchAll();
    }

    public function getItem($id)
    {
        $project = $this->_db->query('SELECT * FROM projects WHERE id = ' . $id)->fetchRow();
        $items = $this->_db->query('SELECT * FROM project_items WHERE project_id = ' . $id)->fetchAll();

        foreach ($items as $subItem) {
            $project['items'][] = [
                'id' => $subItem['id'],
                'title_en' => $subItem['title_en'],
                'text_en' => $subItem['text_en'],
                'city_en' => $project['city_en'],
                'title' => $subItem['title'],
                'text' => $subItem['text'],
                'city' => $project['city'],
                'img_org' => Helper::getImagePath($subItem['file_name_org']),
                'img_des' => Helper::getImagePath($subItem['file_name_des']),
                'img_mob' => Helper::getImagePath($subItem['file_name_mob']),
                'img_min_des' => Helper::getImagePath($subItem['file_name_min_des']),
                'img_min_mob' => Helper::getImagePath($subItem['file_name_min_mob']),
            ];
        }
        return $project;
    }

    /**
     * @param $id
     * @param $lang
     * @return mixed
     */
    public function getItemByIdAndLang($id, $lang)
    {
        $sql = "SELECT * FROM projects WHERE STATUS = 1 AND id = " . $id;

        $item = $this->_db->query($sql)->fetchRow();

        $category = $this->_db->query('SELECT * FROM interiors WHERE id = ' . $item['category'])->fetchRow();

        if (is_null($item)) {
            throw new InvalidArgumentException('Page not found' , 404);
        }
        $data['id'] = $item['id'];
        $data['url'] = $item['url'];
        $data['category'] = $category['url'];

        if ($lang == 'en') {
            $data['title'] = $item['title_en'];
            $data['city'] = $item['city_en'];
            $data['meta_keywords'] = $item['meta_keywords_en'];
            $data['meta_description'] = $item['meta_description_en'];
            $data['category_title'] = $category['title_en'];
        } else {
            $data['name'] = $item['title'];
            $data['title'] = $item['title'];
            $data['city'] = $item['city'];
            $data['meta_keywords'] = $item['meta_keywords'];
            $data['meta_description'] = $item['meta_description'];
            $data['category_title'] = $category['title'];
        }
        $subItems = $this->_db->query('SELECT * FROM project_items WHERE project_id = ' . $item['id'])->fetchAll();
        $data['items'] = [];

        foreach ($subItems as $subItem) {
            if ($lang == 'en') {
                $data['items'][] = [
                    'img_org' => Helper::getImagePath($subItem['file_name_org']),
                    'img_des' => Helper::getImagePath($subItem['file_name_des']),
                    'img_mob' => Helper::getImagePath($subItem['file_name_mob']),
                    'img_min_des' => Helper::getImagePath($subItem['file_name_min_des']),
                    'img_min_mob' => Helper::getImagePath($subItem['file_name_min_mob']),
                    'title' => $subItem['title_en'],
                    'text' => $subItem['text_en'],
                    'city' => $item['city_en']
                ];
            } else {
                $data['items'][] = [
                    'img_org' => Helper::getImagePath($subItem['file_name_org']),
                    'img_des' => Helper::getImagePath($subItem['file_name_des']),
                    'img_mob' => Helper::getImagePath($subItem['file_name_mob']),
                    'img_min_des' => Helper::getImagePath($subItem['file_name_min_des']),
                    'img_min_mob' => Helper::getImagePath($subItem['file_name_min_mob']),
                    'title' => $subItem['title'],
                    'text' => $subItem['text'],
                    'city' => $item['city']
                ];
            }
        }

        return $data;
    }

    public function saveItem($id, $data) {

        $status = (isset($data['status']) && $data['status'] == '1') ? 1 : 0;

        $sql = "UPDATE projects SET "
            . "status = " . $status . ", "
            . "meta_description = '" . $this->_db->escape($data['meta_description']) . "', "
            . "meta_keywords = '" . $this->_db->escape($data['meta_keywords']) . "', "
            . "meta_description_en = '" . $this->_db->escape($data['meta_description_en']) . "', "
            . "meta_keywords_en = '" . $this->_db->escape($data['meta_keywords_en']) . "', "
            . "category = " . intval($data['category']) . ", "
            . "title = '" . $this->_db->escape($data['title']) . "', "
            . "url = '" . $this->_db->escape($data['url']) . "', "
            . "city = '" . $this->_db->escape($data['city']) . "', "
            . "title_en = '" . $this->_db->escape($data['title_en']) . "', "
            . "city_en = '" . $this->_db->escape($data['city_en']) . "' "
            . " WHERE id = " . $id;

        $this->_db->query($sql)->exec();

        foreach ($data['items'] as $itemId => $item) {
            $itemId = (int) $itemId;

            $sql = "UPDATE project_items SET "
                . "title = '" . $this->_db->escape($item['title']) . "', "
                . "text = '" . $this->_db->escape($item['text']) . "', "
                . "title_en = '" . $this->_db->escape($item['title_en']) . "', "
                . "text_en = '" . $this->_db->escape($item['text_en']) . "' "
                . " WHERE id = " . $itemId . " AND project_id = " . $id;

            $this->_db->query($sql)->exec();
        }
    }

    public function saveItemImages($data) {

        $sql = "UPDATE project_items SET "
            . "file_name_org = '" . $data['file_name_org'] . "', "
            . "file_name_des = '" . $data['file_name_des'] . "', "
            . "file_name_mob = '" . $data['file_name_mob'] . "', "
            . "file_name_min_des = '" . $data['file_name_min_des'] . "', "
            . "file_name_min_mob = '" . $data['file_name_min_mob'] . "' "
            . " WHERE id = {$data['id']} AND project_id = {$data['project_id']}";

        $this->_db->query($sql)->exec();
    }
}