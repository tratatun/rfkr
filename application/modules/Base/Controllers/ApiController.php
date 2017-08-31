<?php

namespace Base\Controllers;

use Base\Core\Controller\ControllerAbstract;
use Base\Models\Projects;
use Base\Models\Twitter;
use Base\Config;

/**
 * Class ApiController
 *
 * @package Base\Controllers
 */
class ApiController extends ControllerAbstract
{
    const STATUS_SUCCESS = 1;
    const STATUS_FAIL = 0;
    /**
     * @var mixed
     */
    protected $result = [
        'status' => self::STATUS_FAIL,
        'error' => '',
        'data' => []
    ];

    /**
     *
     */
    public function getLastTweetAction()
    {
        try {
            $twit = Twitter::getInstance()->get('statuses/user_timeline', array(
                'screen_name' => Config::get('application')['twitter']['owner'],
                'count' => 1,
            ))[0];

            $this->result = [
                'status' => self::STATUS_SUCCESS,
                'data' => $twit,
            ];
        } catch(\Exception $e) {
            $this->result['error'] = $e->__toString();
        }
    }

    /**
     *
     */
    public function createImageItemAction()
    {
        if ($this->getRequest()->isPost()) {
            try {
                (new Projects())->createImageItem($this->getRequest()->project);
                $this->result['status'] = self::STATUS_SUCCESS;
                return;
            } catch (\Exception $e) {

            }
        }
    }

    /**
     *
     */
    public function deleteImageItemAction()
    {
        if ($this->getRequest()->isPost()) {
            try {
                (new Projects())->deleteImageItem($this->getRequest()->id);
                $this->result['status'] = self::STATUS_SUCCESS;
                return;
            } catch (\Exception $e) {

            }
        }
    }

    public function postDispatch()
    {
        // todo: text/json
        echo json_encode($this->result);
    }
}