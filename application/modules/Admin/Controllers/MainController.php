<?php

namespace Admin\Controllers;

use Base\Models\Menu;
use Base\Models\Site;

/**
 * Class Index
 */
final class MainController extends Base {

    public function indexAction() {

        if ($this->getRequest()->isPost()) {
            $menu = $this->getRequest()->getPost('menu');
            $site = $this->getRequest()->getPost('site');

            (new Site())->save($site);
            (new Menu())->save($menu);

            $this->redirect('/admin/main');
        }

        $site = new Site();
        $siteData = $site->getData();

        $menu = new Menu();
        $menuData = $menu->getAllGroupByLang();

        $this->view->set('menu', $menuData);
        $this->view->set('site', $siteData);
    }
}