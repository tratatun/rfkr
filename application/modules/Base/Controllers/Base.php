<?php

namespace Base\Controllers;

use Base\I18n;
use Base\Models\Contacts;
use Base\Models\Menu;
use Base\Models\Page;
use Base\Models\Site;
use Base\Models\Twitter;

use Base\Config;

/**
 * Class BaseController
 *
 * @package Controllers
 */
class Base extends Layout
{
    /**
     * @var
     */
    protected $lang;

    /**
     * @throws \Base\Core\Controller\Exception
     */
    public function init()
    {
        $this->initView();
        $this->view->set('baseUrl', $this->getRequest()->getBaseUrl());

        $this->initLayout();
        $this->layout->setTemplateName('base/layout.phtml');
        $this->layout->set('currentUrl', $_SERVER['REQUEST_URI']);

        $localizeConfig = Config::get('application')['i18n'];

        $lang = $this->getRequest()->getParam(
            'language',
            isset($_COOKIE['lang']) ? $_COOKIE['lang'] : $localizeConfig['defaultLang']
        );

        \Base\I18n::getInstance()->setDirectory($localizeConfig['path'])->setLang($lang);

        $this->lang = $lang;
        $this->layout->set('currentLang', $this->lang);
        $page = $this->getRequest()->getActionName();
        /**
         * Menu
         */
        $menu = new Menu();
        $this->layout->set('menu', $menu->getMain($page, $this->lang));
        $this->layout->set('footerMenu', $menu->getFooter($this->lang));

        /**
         * Contacts
         */
        $contacts = (new Contacts())->get($this->lang);
        $this->layout->set('contacts', $contacts);

        /**
         * Page title, page data (subtitle, meta and etc)
         */

        $siteData = (new Site())->getData();

        if ($this->lang == 'en') {
            $siteTitle = $siteData['common_title_en'];
        } else {
            $siteTitle = $siteData['common_title'];
        }

        $this->layout->set('pageTitle', $siteTitle);

        $pageData = (new Page())->getData($page, $this->lang);

        $this->layout->set('page', $pageData);
        $this->view->set('page', $pageData);

        /**
         * About preview for header
         */
        $aboutPageData = (new Page())->getData('about', $this->lang);
        $this->layout->set('aboutPreview', $aboutPageData['preview']);

        /**
         * System data
         */
        $this->layout->set('controller', $this->getRequest()->getControllerName());
        $this->layout->set('action', $this->getRequest()->getActionName());
        $this->layout->set('baseUrl', $this->getRequest()->getBaseUrl());
    }
}