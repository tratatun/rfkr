<?php

namespace Base;

/**
 * Authentication of user and create user session
 *
 * @package classes
 * @author Eugene Orekhov <oeswww@gmail.com>
 */
class Auth
{
    use SingletonTrait;

    /**
     * Singleton instance
     *
     * @var Auth
     */
    protected static $instance;

    /**
     * Database object
     *
     * @var Db
     */
    protected $db;

    /**
     * Return an instance of Auth
     *
     * @return Auth
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * User authenticate
     *
     * @return bool
     */
    public function authenticate()
    {
        if (!isset($_COOKIE['user_id'])  || !isset($_COOKIE['user_hash'])) {
            return false;
        }

        $userId = (int) $this->db->escape($_COOKIE['user_id']);
        $hash = (string) $_COOKIE['user_hash'];

        $user = $this->db->query("SELECT `hash` FROM `users` WHERE `id` = " . $userId)->fetchRow();
        
        if ($user['hash'] == $hash) {
            return true;
        }

        return false;
    }

    /**
     * Check user data. And if it correct create user session
     *
     * @param $login
     * @param $password
     * @return int User id
     */
    public function login($login, $password) {

        $login = (string) $this->db->escape($login);

        $user = $this->db->query("SELECT * FROM `users` WHERE `login` = '" . $login . "'")->fetchRow();

        if ($user === false) {
            return false;
        }

        if ($user['password'] !== md5(md5($password))) {
            return false;
        }

        if (empty($user['hash'])) {
            $hash = md5($this->generateCode(32));

            try {
                $this->db->query("UPDATE `users` SET `hash` = '" . $hash . "' WHERE `id` = " . $user['id'])->exec();
            }
            catch (\Exception $e) {
                return false;
            }
        } else {
            $hash = $user['hash'];
        }

        $inMonth = time() + 60 * 60 * 24 * 30;

        setcookie('user_id', $user['id'], $inMonth, '/');
        setcookie('user_hash', $hash, $inMonth, '/');

        return $user;
    }

    /**
     * Close user session
     */
    public function logout()
    {
        try {
            $this->db->query("UPDATE `users` SET `hash` = '' WHERE `id` = " . $_COOKIE['user_id'])->exec();
        }
        catch (\Exception $e) {
            return false;
        }

        setcookie('user_id', '', time() - 1, '/');
        setcookie('user_hash', '', time() - 1, '/');

        return true;
    }

    /**
     * Singleton pattern implementation makes "new" unavailable
     */
    protected function __construct()
    {
        $this->db = new Db(Config::get('application')['db']);
    }

    /**
     * Generate random hash
     *
     * @param int $length
     * @return string
     */
    private function generateCode($length = 6)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789';
        $code = '';

        $len = strlen($chars) - 1;

        while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0, $len)];
        }

        return $code;
    }
}