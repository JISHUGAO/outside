<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/22 0022
 * Time: 13:32
 */
namespace api\modules\v1\controllers;

use League\FactoryMuffin\Exceptions\ModelException;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use api\utils\MessageHelper;

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
                $message = "操作成功";
                $data = empty($response->data) ? [] : $response->data;
                $response->data = [
                    'code' => $code,
                    'msg' => $message,
                    'data' => []
                ];

                //如果有错误
                if (isset($data['code']) && $data['code'] > 0) {
                    $response->data['code'] = $data['code'];
                    $response->data['msg'] = $data['message'];
                    //如果有分页
                } elseif (isset($data['totalCount'])) {
                    $response->data['data'] = $data['items'];
                    $response->data['totalCount'] = (int)$data['totalCount'];
                    $response->data['size'] = $data['size'];
                } elseif($data === false) {
                    $response->data['msg'] = "操作失败";
                    $response->data['code'] = 1;
                } else {
                    $response->data['data'] = $data;
                }

            }
        });
    }
}
