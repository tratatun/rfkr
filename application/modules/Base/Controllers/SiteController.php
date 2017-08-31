<?php

namespace Base\Controllers;

use Base\Config;
use Base\I18n;
use Base\Models\Contacts;
use Base\Models\DesignCategories;
use Base\Models\Gallery;
use Base\Models\Press;
use Base\Models\PressCategories;
use Base\Models\Projects;
use Base\Models\Services;

/**
 * Class SiteController
 *
 * @package Base\Controllers
 */
class SiteController extends Base
{
    /**
     *
     */
    public function IndexAction()
    {
        $model = new Gallery();
        $gallery = $model->getData($this->lang);
        $this->view->set('gallery', $gallery);
    }

    /**
     *
     */
    public function servicesAction()
    {
        if ($this->getRequest()->isPost()) {
            
            $data = $this->getRequest()->getPost();
            
            if (empty($data['email']) && isset($data['hash1'])
                && isset($_COOKIE['hash1']) && $_COOKIE['hash1'] == $data['hash1']
            ) {
                $name = htmlspecialchars(strip_tags(trim($data['name'])));
                $contact = htmlspecialchars(strip_tags(trim($data['contact'])));
                $phone = htmlspecialchars(strip_tags(trim($data['phone'])));
                $meters = htmlspecialchars(strip_tags(trim($data['meters'])));
                $type = htmlspecialchars(strip_tags(trim($data['type'])));

                if (!empty($name) && !empty($contact) && filter_var($contact, FILTER_VALIDATE_EMAIL)) {

                    $smtp = Config::get('application')['smtp'];

                    $msgText
                        = 'Sender name: ' . $name . "\n"
                        . 'Sender phone: ' . $phone . "\n"
                        . 'Sender email: ' . $contact . "\n"
                        . 'Date: ' . date('Y-m-d H:m:i') . "\n"
                        . 'Object type: ' . $type . "\n"
                        . 'Total area: ' . $meters . "\n"
                        ;

                    $message = new \Zend\Mail\Message();
                    $message
                        ->setSubject('Message from ' . $_SERVER['HTTP_HOST'] . ' service form')
                        ->setFrom($contact)
                        ->setTo(array($smtp['emailTo1'], $smtp['emailTo2']))
                        ->setBody($msgText);                    
                    
                    $options = new \Zend\Mail\Transport\SmtpOptions([
                        'name' => $smtp['name'],
                        'host' => $smtp['host'],
                        'port' => $smtp['port'],
                        'connection_class'  => 'login',
                        'connection_config' => $smtp['login'],
                    ]);

                    $transport = new \Zend\Mail\Transport\Smtp($options);
                    $transport->send($message);
                }
            }
        }    
        $hash1 = md5(time() . 'blabla1');
        setcookie('hash1', $hash1, time() + 900, '/');

        $columns = (new Services())->getData($this->lang);
        $this->view->set('columns', $columns);
        $this->view->set('hash1', $hash1);
    }

    /**
     *
     */
    public function projectsAction()
    {
        $page = (int) $this->getRequest()->getParam('page', 1);
        $category = $this->getRequest()->getParam('category');


        $projects = (new Projects())->getData($this->lang, $page, $category);

        $categoryObj = (new DesignCategories())->getByIdAndLang($category, $this->lang);

        $this->layout->set('page', [
            'metaKeywords' => $categoryObj['meta_keywords'],
            'metaDescription' => $categoryObj['meta_description'],
            'pageTitle' => $categoryObj['title'],
        ]);

        $this->view->set('projects', $projects['data']);
        $this->view->set('pages', $projects['pages']);
        $this->view->set('page', $page);
        $this->view->set('text', $categoryObj['text']);
    }

    /**
     *
     */
    public function projectAction()
    {
        $id = $this->getRequest()->getParam('project');
        if (is_null($id)) {
            throw new \InvalidArgumentException('Page not found', 404);
        }

        $data = (new Projects())->getItemByIdAndLang($id, $this->lang);

        $this->view->set('project', $data);

        $this->layout->set('page', [
            'metaKeywords' => $data['meta_keywords'],
            'metaDescription' => $data['meta_description'],
            'pageTitle' => $data['title']
        ]);

        $this->view->set('breadcrumbs', [
            '/design.html' => I18n::getInstance()->get('all_categories'),
            '/design/' . $data['category'] => $data['category_title'],
        ]);
    }

    /**
     *
     */
    public function pressAction()
    {        
        $categories_all = (new PressCategories())->getData($this->lang); 
        $cat_all[0]['id'] = '-1';
        $cat_all[0]['url'] = 'all';
        $cat_all[0]['title'] = I18n::getInstance()->get('all_categories');
        

        $categories_all = array_merge($cat_all,$categories_all);
    
        $page = (int) $this->getRequest()->getParam('page', 1);  
        $category = $this->getRequest()->getParam('category');
            
        foreach($categories_all as $key=>$cat) {
            if($cat['url'] == $category) {
                $category_this = $cat;
                $category_this['full_url'] = $this->lang.'/press/'.$cat['url'].'/';
                
            }
            $allowed_categories[] = $cat['url'];
            $categories_all[$key]['url'] = $this->lang.'/press/'.$cat['url'].'/';
        }
        
        if (!in_array($category, $allowed_categories)) {
            throw new \InvalidArgumentException('Page not found', 404);
        }        
        
        $list = (new Press())->getData($this->lang, $page, $category_this); 
        
        $this->view->set('list', $list['data']);
        $this->view->set('pages', $list['pages']);
        $this->view->set('categories', $categories_all);
        $this->view->set('category_this', $category_this);
        $this->view->set('page_current', $page); 
        
        $this->view->set('breadcrumbs', [
            '/press/all/' => I18n::getInstance()->get('publications'),
            '/press/' . $category_this['url'] => $category_this['title'],
        ]);      
        
        if($category_this['url'] != 'all') {
            $this->layout->set('page', [
                'metaKeywords' => $category_this['meta_keywords'],
                'metaDescription' => $category_this['meta_description'],
                'pageTitle' => $category_this['page_title']
            ]);
        }
    }

    /**
     *
     */
    public function aboutAction()
    {
        $contacts = (new Contacts())->get($this->lang);
        $this->view->set('contacts', $contacts);
    }   
    
    public function pressitemAction()
    {
        $id = $this->getRequest()->getParam('pressitem');        
        $pressitem = (new Press())->getItem($id);
        $this->view->set('pressitem', $pressitem);
        
        $this->layout->set('page', [
            'metaKeywords' => $pressitem['meta_keywords'],
            'metaDescription' => $pressitem['meta_description'],
            'pageTitle' => $pressitem['title']
        ]);        
        
        $this->view->set('breadcrumbs', [
            //'/press.html' => I18n::getInstance()->get('all_categories'),
            '/press/all/' => I18n::getInstance()->get('publications'),
        ]);
    }

    /**
     *
     */
    public function designAction()
    {
        $designCategories = (new DesignCategories())->getData($this->lang);
        $this->view->set('items', $designCategories);
    }

    /**
     *
     */
    public function langAction()
    {
        $lang = $this->getRequest()->get('lang');
        $page = $this->getRequest()->get('page');

        $page = substr($page, strpos($page, '/', 1) + 1);
        $page = ltrim($page, '/');

        $url = '/' . $lang . '/' . $page;

        setcookie('lang', $lang, time() + 60 * 60 * 24 * 30 * 12, '/');
        $this->redirect($url);
    }

    public function contactsAction()
    {
        if ($this->getRequest()->isPost()) {
            
            $data = $this->getRequest()->getPost();

            if (empty($data['email']) && isset($data['hash'])
                && isset($_COOKIE['hash']) && $_COOKIE['hash'] == $data['hash']
            ) {
                $text = htmlspecialchars(strip_tags(trim($data['text'])));
                $name = htmlspecialchars(strip_tags(trim($data['name'])));
                $contact = htmlspecialchars(strip_tags(trim($data['contact'])));
                $phone = htmlspecialchars(strip_tags(trim($data['phone'])));

                if (!empty($text) && !empty($name) && !empty($contact) && filter_var($contact, FILTER_VALIDATE_EMAIL)) {

                    $smtp = Config::get('application')['smtp'];

                    $msgText
                        = 'Sender name: ' . $name . "\n"
                        . 'Sender phone: ' . $phone . "\n"
                        . 'Sender email: ' . $contact . "\n"
                        . 'Date: ' . date('Y-m-d H:m:i') . "\n"
                        . 'Message: ' . "\n"
                        . substr($text, 0, 500);

                    $message = new \Zend\Mail\Message();
                    $message
                        ->setSubject('Message from ' . $_SERVER['HTTP_HOST'] . ' contacts form')
                        ->setFrom($contact)
                        ->setTo(array($smtp['emailTo1'], $smtp['emailTo2']))
                        ->setBody($msgText);

                    $options = new \Zend\Mail\Transport\SmtpOptions([
                        'name' => $smtp['name'],
                        'host' => $smtp['host'],
                        'port' => $smtp['port'],
                        'connection_class'  => 'login',
                        'connection_config' => $smtp['login'],
                    ]);

                    $transport = new \Zend\Mail\Transport\Smtp($options);
                    $transport->send($message);
                }
            }
        }

        $hash = md5(time() . 'blabla');

        setcookie('hash', $hash, time() + 900, '/');

        $contact = (new Contacts())->get($this->lang);
        $this->view->set('contacts', $contact);
        $this->view->set('hash', $hash);
    }
}