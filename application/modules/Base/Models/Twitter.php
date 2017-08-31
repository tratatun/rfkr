<?php

namespace Base\Models;

use Base\Config;
use Base\SingletonTrait;
use TwitterOAuth\TwitterOAuth;

/**
 * Class FrontController
 *
 * @package classes
 * @author Eugene Orekhov <oeswww@gmail.com>
 */
final class Twitter {

    use SingletonTrait;

    /**
     * An instance of front controller
     *
     * @var null|TwitterOAuth
     */
    private static $_instance;

    /**
     * Create an instance of front controller
     */
    public static function getInstance() {

        if (is_null(self::$_instance)) {

            $twConfig = Config::get('application')['twitter'];

            $tw = new TwitterOAuth([
                'consumer_key' => $twConfig['apiKey'],
                'consumer_secret' => $twConfig['apiSecret'],
                'oauth_token' => $twConfig['accessToken'],
                'oauth_token_secret' => $twConfig['accessTokenSecret'],
                'output_format' => 'array',
            ]);

            self::$_instance = $tw;
        }

        return self::$_instance;
    }
}