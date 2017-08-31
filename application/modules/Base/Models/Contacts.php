<?php

namespace Base\Models;

use Base\Config;
use Base\Db;


/**
 * Class Contacts
 *
 * @package Models
 */
class Contacts {

    /**
     * @var Db
     */
    protected $_db;

    const AVATAR_FILE_NAME = 'img_user.jpg';

    /**
     *
     */
    public function __construct() {

        $this->_db = new Db(Config::get('application')['db']);
    }

    /**
     * Return contacts data
     *
     * @param string $lang
     * @return array
     */
    public function get($lang = 'en') {

        $data = $this->_db->query('SELECT * from contacts WHERE id = 1')->fetchRow();

        if ($lang == 'en') {
            return [
                'name' => $data['name_en'],
                'who' => $data['who_en'],
                'avatar' => Helper::getImagePath($data['avatar']),
                'phone_1' => $data['phone_1'],
                'phone_2' => $data['phone_2'],
                'phone_3' => $data['phone_3'],
                'email_1' => $data['email_1'],
            ];
        } else {
            return [
                'name' => $data['name'],
                'who' => $data['who'],
                'avatar' => Helper::getImagePath($data['avatar']),
                'phone_1' => $data['phone_1'],
                'phone_2' => $data['phone_2'],
                'phone_3' => $data['phone_3'],
                'email_1' => $data['email_1'],
            ];
        }
    }

    public function save($data) {

        $this->_db->query("UPDATE contacts SET "
            . "name = '" . $this->_db->escape($data['name']) . "', "
            . "name_en = '" . $this->_db->escape($data['name_en']) . "', "
            . ((isset($data['avatar'])) ? ("avatar = '" . $this->_db->escape($data['avatar']) . "', ") : '')
            . "who = '" . $this->_db->escape($data['who']) . "', "
            . "who_en = '" . $this->_db->escape($data['who_en']) . "', "
            . "phone_1 = '" . $this->_db->escape($data['phone_1']) . "', "
            . "phone_2 = '" . $this->_db->escape($data['phone_2']) . "', "
            . "phone_3 = '" . $this->_db->escape($data['phone_3']) . "', "
            . "email_1 = '" . $this->_db->escape($data['email_1']) . "' "
            . "WHERE id = 1"
        )->exec();
    }

    public function getAll() {
        $data = $this->_db->query('SELECT * FROM contacts')->fetchRow();
        $data['avatar'] = Helper::getImagePath($data['avatar']);
        return $data;
    }
}