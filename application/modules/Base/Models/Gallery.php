<?php

namespace Base\Models;

use Base\Config;
use Base\Db;
use Base\Exception;

/**
 * Class Projects
 * @package Models
 */
class Gallery {

    const MIN_IMAGE_WIDTH = 1300;

    public static $images = [
        1 => [
            'org' => [
                'name' => 'gallery_org_item_',
                'db_column' => 'file_name_org'
            ],
            'desc' => [
                'name' => 'gallery_desc_item_',
                'db_column' => 'file_name_des',
                'width' => 1528,
                'height' => 850
            ],
            'mobile' => [
                'name' => 'gallery_mob_item_',
                'db_column' => 'file_name_mob',
                'width' => 764,
                'height' => 424
            ],
        ],
        2 => [
            'org' => [
                'name' => 'gallery_org_item_',
                'db_column' => 'file_name_org'
            ],
            'desc' => [
                'name' => 'gallery_desc_item_',
                'db_column' => 'file_name_des',
                'width' => 872,
                'height' => 850
            ],
            'mobile' => [
                'name' => 'gallery_mob_item_',
                'db_column' => 'file_name_mob',
                'width' => 436,
                'height' => 425
            ],
        ],
        3 => [
            'org' => [
                'name' => 'gallery_org_item_',
                'db_column' => 'file_name_org'
            ],
            'desc' => [
                'name' => 'gallery_desc_item_',
                'db_column' => 'file_name_des',
                'width' => 872,
                'height' => 850
            ],
            'mobile' => [
                'name' => 'gallery_mob_item_',
                'db_column' => 'file_name_mob',
                'width' => 436,
                'height' => 425
            ],
        ],
        4 => [
            'org' => [
                'name' => 'gallery_org_item_',
                'db_column' => 'file_name_org'
            ],
            'desc' => [
                'name' => 'gallery_desc_item_',
                'db_column' => 'file_name_des',
                'width' => 872,
                'height' => 850
            ],
            'mobile' => [
                'name' => 'gallery_mob_item_',
                'db_column' => 'file_name_mob',
                'width' => 436,
                'height' => 425
            ],
        ],
        5 => [
            'org' => [
                'name' => 'gallery_org_item_',
                'db_column' => 'file_name_org'
            ],
            'desc' => [
                'name' => 'gallery_desc_item_',
                'db_column' => 'file_name_des',
                'width' => 872,
                'height' => 850
            ],
            'mobile' => [
                'name' => 'gallery_mob_item_',
                'db_column' => 'file_name_mob',
                'width' => 436,
                'height' => 425
            ],
        ]

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

    /**
     *
     * @param string $lang
     * @throws Exception
     * @return array
     */
    public function getData($lang) {
        $items = $this->_db->query('SELECT * FROM gallery')->fetchAll();
        $data = [];

        foreach ($items as $key => $item) {
            if ($lang == 'ru') {
                $temp = [
                    'id' => $item['id'],
                    'title' => $item['title'],
                    'text' => nl2br($item['text']),
                    'img_org' => Helper::getImagePath($item['file_name_org']),
                    'img_des' => Helper::getImagePath($item['file_name_des']),
                    'img_mob' => Helper::getImagePath($item['file_name_mob']),
                ];
            } else {
                $temp = [
                    'id' => $item['id'],
                    'title' => $item['title_en'],
                    'text' => nl2br($item['text_en']),
                    'img_org' => Helper::getImagePath($item['file_name_org']),
                    'img_des' => Helper::getImagePath($item['file_name_des']),
                    'img_mob' => Helper::getImagePath($item['file_name_mob']),
                ];
            }
            $data[$key] = $temp;
        }
        return $data;
    }

    public function getAll()
    {
        $items = $this->_db->query('SELECT * FROM gallery')->fetchAll();
        $data = [];

        foreach ($items as $key => $item) {
            $data[$key] = [
                'id' => $item['id'],
                'title' => $item['title'],
                'text' => $item['text'],
                'title_en' => $item['title_en'],
                'text_en' => $item['text_en'],
                'img_org' => Helper::getImagePath($item['file_name_org']),
                'img_des' => Helper::getImagePath($item['file_name_des']),
                'img_mob' => Helper::getImagePath($item['file_name_mob']),
            ];
        }
        return $data;
    }

    public function saveItem($data) {
        foreach($data['item'] as $id => $item) {
            $sql = "UPDATE gallery SET "
                . "title = '" . $this->_db->escape($item['title']) . "', "
                . "city = '" . $this->_db->escape($item['city']) . "', "
                . "text = '" . $this->_db->escape($item['text']) . "', "
                . "title_en = '" . $this->_db->escape($item['title_en']) . "', "
                . "text_en = '" . $this->_db->escape($item['text_en']) . "' "
                . " WHERE id = " . (int) $id;

            $this->_db->query($sql)->exec();
        }

    }

    public function saveItemImages($data) {

        $sql = "UPDATE gallery SET "
            . "file_name_org = '" . $data['file_name_org'] . "', "
            . "file_name_des = '" . $data['file_name_des'] . "', "
            . "file_name_mob = '" . $data['file_name_mob'] . "' "
            . " WHERE id = {$data['id']}";

        $this->_db->query($sql)->exec();
    }
}