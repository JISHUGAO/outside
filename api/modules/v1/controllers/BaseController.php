<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/22 0022
 * Time: 13:32
 */
namespace api\modules\v1\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class BaseController extends Controller
{
    public $enableCsrfValidation = false;

    public function init()
    {
        $this->initResponse();
    }

    protected function initResponse()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $headers = Yii::$app->response->headers;
        $headers->add('Access-Control-Allow-Origin', Yii::$app->request->headers->get('Origin'));
        $headers->add('Access-Control-Allow-Headers', 'Content-Type, Content-Length, Authorization, Accept, X-Requested-With');
        $headers->add('Access-Control-Allow-Methods', 'PUT, POST, GET, DELETE, OPTIONS');
        $headers->add('Access-Control-Allow-Credentials', 'true');
        Yii::$app->response->on('beforeSend', function($event) {
            $response = $event->sender;
            if ($response->isSuccessful) {
                $code = 0;
                if (!isset($response->data['code'])) {
                    $response->data = [
                        'code' => $code,
                        'msg' => '',
                        'data' => $response->data
                    ];
                }

            }
        });
    }
}
