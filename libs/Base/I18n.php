<?php

namespace Base;

/**
 * Class I18n
 *
 * @package Base
 * @author Eugene Orekhov <oeswww@gmail.com>
 */
class I18n
{
    use SingletonTrait;

    /**
     * @var string
     */
    protected $lang = self::LANG_RU;

    /**
     * @var array
     */
    public static $availableLanguages = [
        self::LANG_EN,
        self::LANG_RU
    ];

    /**
     * Languages
     */
    const LANG_RU = 'ru';
    const LANG_EN = 'en';

    /**
     * Singleton instance
     *
     * @var I18n
     */
    private static $instance;

    /**
     * Directory with translates
     *
     * @var string
     */
    protected $directory;

    /**
     * Translate data
     *
     * @var array
     */
    protected $data = [];

    /**
     * Return an instance of I18n
     *
     * @return I18n
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Set specified language
     *
     * @param $lang
     * @throws \InvalidArgumentException
     */
    public function setLang($lang)
    {
        if (!in_array($lang, self::$availableLanguages)) {
            throw new \InvalidArgumentException('Specified language is an unsupported. Available languages: '
                . implode(', ', self::$availableLanguages));
        }
        $this->lang = $lang;
    }


    /**
     * Get current language
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set directory with translates
     *
     * @param $directory
     * @return $this
     */
    public function setDirectory($directory)
    {
        $this->directory = $directory;
        return $this;
    }

    /**
     * Get localized string
     *
     * @param $string
     * @return string
     * @throws \InvalidArgumentException
     */
    public function get($string)
    {
        if (empty($this->data)) {
            $this->load($this->lang);
        }

        if (!isset($this->data[$string])) {
            throw new \InvalidArgumentException('Specified string "' . $string . '" does not exist in localization');
        }
        return $this->data[$string];
    }

    /**
     * Load translate data for specified language
     *
     * @param $lang
     * @throws \RuntimeException
     */
    protected function load($lang)
    {
        $fileName = $this->directory . DS . $lang . '.php';

        if (!file_exists($fileName)) {
            throw new \RuntimeException($lang . ' localization file does not exist');
        }

        $this->data = require $fileName;

    }
}