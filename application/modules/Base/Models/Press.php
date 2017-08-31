<?php

namespace Base\Models;

use Base\Config;
use Base\Db;
use Base\I18n;

/**
 * Class Press
 * 
 * @package Models
 */
class Press {

    /**
     * @var Db
     */
    protected $_db;
    
    const COUNT_ON_PAGE = 5;

    public static $images = [
        1 => [
            'org' => [
                'name' => 'press_1_org_item_',
                'db_column' => 'file_name_org'
            ],
            'desc' => [
                'name' => 'press_1_desc_item_',
                'db_column' => 'file_name_des',
                'width' => 0,
                'height' => 900
            ],
            'mobile' => [
                'name' => 'press_1_mob_item_',
                'db_column' => 'file_name_mob',
                'width' => 0,
                'height' => 450
            ],
            'tmb' => [
                'name' => 'press_1_min_item_',
                'db_column' => 'file_name_tmb',
                'width' => 112,
                'height' => 162
            ],
        ],
        2 => [
            'org2' => [
                'name' => 'press_2_org_item_',
                'db_column' => 'file_name_2_org'
            ],
            'desc2' => [
                'name' => 'press_2_desc_item_',
                'db_column' => 'file_name_2_des',
                'width' => 0,
                'height' => 900
            ],
            'mobile2' => [
                'name' => 'press_2_mob_item_',
                'db_column' => 'file_name_2_mob',
                'width' => 0,
                'height' => 450
            ],
            'tmb2' => [
                'name' => 'press_2_min_item_',
                'db_column' => 'file_name_2_tmb',
                'width' => 112,
                'height' => 162
            ],
        ]

    ];

    /**
     *
     */
    public function __construct() {

        $this->_db = new Db(Config::get('application')['db']);
    }
    public function createItem()
    {
        $sql = "INSERT INTO press (date, status, url, title, title_en, text, text_en, meta_keywords, meta_description, meta_keywords_en, meta_description_en) VALUES ('".date("Y-m-d h:m:s",time())."', 0, 'press-" . time() . "','Заголовок', 'Title', 'Описание', 'Description', 'Ключевые слова', 'Мета описание', 'Meta keywords', 'Meta Description')";
        $this->_db->query($sql)->exec();
        return $this->_db->getGeneratedId();
    }

    public function deleteById($id)
    {
        $data = $this->_db->query("SELECT file_name_org, file_name_des, file_name_mob, file_name_tmb, file_name_2_org, file_name_2_des, file_name_2_mob, file_name_2_tmb  FROM press WHERE id = $id")->fetchRow();

        foreach ($data as $image) {
            if (!empty($image)) {
                unlink(Helper::getRootImagePath($image));
            }
        }

        $this->_db->query("DELETE FROM press WHERE id = $id")->exec();
    }

    /**
     * @param string $lang
     * @return array
     */
    public function getData($lang = 'en', $page = 1, $category = NULL) {
        if($category['id'] == -1) {// category = all
            $sql = 'SELECT * FROM press WHERE status = 1';    
            $sql_cnt = 'SELECT COUNT(id) as count FROM press WHERE status = 1';
        }
        else {
            $sql = 'SELECT * FROM press WHERE status = 1 AND category ='.$category['id'];
            $sql_cnt = 'SELECT COUNT(id) as count FROM press WHERE status = 1 AND category ='.$category['id'];
        }
        
        $sql .= ' ORDER BY id DESC LIMIT ' . ($page * self::COUNT_ON_PAGE - self::COUNT_ON_PAGE) . ' , ' . self::COUNT_ON_PAGE;
        
        $list = $this->_db->query($sql)->fetchAll();
        
        $count = $this->_db->query($sql_cnt)->fetchRow()['count'];
        
        $countPages = ceil($count / self::COUNT_ON_PAGE);
        $pages = [];

        for ($i = 1; $i <= $countPages; $i++) {
            //remove page-1 double page
            if($i == 1) {
                $pages[$i] = '/' . I18n::getInstance()->getLang() . '/press/'.$category['url'].'/';
            }
            else {
                $pages[$i] = '/' . I18n::getInstance()->getLang() . '/press/'.$category['url'].'/page-' . $i;    
            }
            
        }
        
        $data = [];

        foreach ($list as $item) {
            
            if ($lang == 'en') {
                $data[] = [
                    'id'=> $item['id'],
                    'date' => date("d-m-Y", strtotime($item['date'])),
                    'url' => $item['url'],                    
                    'title' => $item['title_en'],
                    'category' => $item['category'],
                    //'text' => nl2br($item['text_en']),
                    'text' => Helper::trim_txt($item['text_en']),
                    'img_org' => Helper::getImagePath($item['file_name_org']),
                    'img_des' => Helper::getImagePath($item['file_name_des']),
                    'img_mob' => Helper::getImagePath($item['file_name_mob']),
                    'img_tmb' => Helper::getImagePath($item['file_name_tmb']),
                    'img_2_org' => Helper::getImagePath($item['file_name_2_org']),
                    'img_2_des' => Helper::getImagePath($item['file_name_2_des']),
                    'img_2_mob' => Helper::getImagePath($item['file_name_2_mob']),
                    'img_2_tmb' => Helper::getImagePath($item['file_name_2_tmb']),
                ];
            } else {
                $data[] = [
                    'id'=> $item['id'],
                    'date' => date("d-m-Y", strtotime($item['date'])),
                    'url' => $item['url'],
                    'title' => $item['title'],
                    'category' => $item['category'],
                    //'text' => nl2br($item['text']),
                    'text' => Helper::trim_txt($item['text']),
                    'img_org' => Helper::getImagePath($item['file_name_org']),
                    'img_des' => Helper::getImagePath($item['file_name_des']),
                    'img_mob' => Helper::getImagePath($item['file_name_mob']),
                    'img_tmb' => Helper::getImagePath($item['file_name_tmb']),
                    'img_2_org' => Helper::getImagePath($item['file_name_2_org']),
                    'img_2_des' => Helper::getImagePath($item['file_name_2_des']),
                    'img_2_mob' => Helper::getImagePath($item['file_name_2_mob']),
                    'img_2_tmb' => Helper::getImagePath($item['file_name_2_tmb']),
                ];
            }
        }

        return [
            'data' => $data,
            //'categories' =>
            'pages' => $pages
        ];
    }
        

    /**
     * @return array
     */
    public function getList() {

        return $this->_db->query('SELECT * FROM press')->fetchAll();
    }

    /**
     * @param $id
     * @return array
     */
    public function getItem($id)
    {
        $item = $this->_db->query("SELECT * FROM press WHERE id = $id")->fetchRow();
        
        $catname = $this->_db->query("SELECT title FROM press_category WHERE id =".$item['category'])->fetchRow();
        
        $lang = 'ru';
        
        if ($lang == 'en') {
            $item['meta_keywords'] = $item['meta_keywords_en'];
            $item['meta_description'] = $item['meta_description_en'];
        } else {
            $item['meta_keywords'] = $item['meta_keywords'];
            $item['meta_description'] = $item['meta_description'];
        }
        
        return [
            'id' => $item['id'],
            'date' => date("d-m-Y h:m:s", strtotime($item['date'])),
            'url' => $item['url'],
            'status' => $item['status'],
            'title' => $item['title'],
            'category' => $catname['title'],
            'text' => $item['text'],
            'title_en' => $item['title_en'],
            'text_en' => $item['text_en'],
            'img_org' => Helper::getImagePath($item['file_name_org']),
            'img_des' => Helper::getImagePath($item['file_name_des']),
            'img_mob' => Helper::getImagePath($item['file_name_mob']),
            'img_tmb' => Helper::getImagePath($item['file_name_tmb']),
            'img_2_org' => Helper::getImagePath($item['file_name_2_org']),
            'img_2_des' => Helper::getImagePath($item['file_name_2_des']),
            'img_2_mob' => Helper::getImagePath($item['file_name_2_mob']),
            'img_2_tmb' => Helper::getImagePath($item['file_name_2_tmb']),
            'meta_keywords' => $item['meta_keywords'],
            'meta_description' => $item['meta_description'],            
            'meta_keywords_en' => $item['meta_keywords_en'],
            'meta_description_en' => $item['meta_description_en'],            
        ];
    }

    /**
     *
     * @param $id
     * @param $data
     */
    public function saveItem($id, $data) {

        $status = (isset($data['status']) && $data['status'] == '1') ? 1 : 0;

        $sql = "UPDATE press SET "
            . " date = '" . date("Y-m-d h:m:s", strtotime($data['date'])) . "', "
            . " status = '" . $status . "', "
            . "url = '" . $this->_db->escape($data['url']) . "', "
            . "category = '" . $this->_db->escape($data['category']) . "', "
            . " title = '" . $this->_db->escape(trim($data['title'])) . "', "
            . " title_en = '" . $this->_db->escape(trim($data['title_en'])) . "', "
            . " text = '" . $this->_db->escape(trim($data['text'])) . "', "
            . " text_en = '" . $this->_db->escape(trim($data['text_en'])) . "', "
            . "meta_keywords = '" . $this->_db->escape($data['meta_keywords']) . "', "
            . "meta_description = '" . $this->_db->escape($data['meta_description']) . "', "            
            . "meta_keywords_en = '" . $this->_db->escape($data['meta_keywords_en']) . "', "
            . "meta_description_en = '" . $this->_db->escape($data['meta_description_en']) . "' "
            . "WHERE id = " . $this->_db->escape($id);
        $this->_db->query($sql)->exec();
    }

    public function saveItemImages($itemId, $data)
    {
        switch ($itemId) {
            case 1:
                $sql = "UPDATE press SET "
                    . "file_name_org = '" . $data['file_name_org'] . "', "
                    . "file_name_des = '" . $data['file_name_des'] . "', "
                    . "file_name_mob = '" . $data['file_name_mob'] . "', "
                    . "file_name_tmb = '" . $data['file_name_tmb'] . "' "
                    . "WHERE id = {$data['id']}" ;
                break;
            case 2:
                $sql = "UPDATE press SET "
                    . "file_name_2_org = '" . $data['file_name_2_org'] . "', "
                    . "file_name_2_des = '" . $data['file_name_2_des'] . "', "
                    . "file_name_2_mob = '" . $data['file_name_2_mob'] . "', "
                    . "file_name_2_tmb = '" . $data['file_name_2_tmb'] . "' "
                    . "WHERE id = {$data['id']}" ;
                break;
        }
        $this->_db->query($sql)->exec();
    }
}