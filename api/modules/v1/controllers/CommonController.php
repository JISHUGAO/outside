<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/15 0015
 * Time: 17:33
 */

namespace api\modules\v1\controllers;

use common\models\AppFeedBack;
use common\models\AppVersion;
use Yii;
use yii\web\Response;

class CommonController extends BaseController
{
    public $layout = false;
    public function actionSendVerifyCode() {
        $username = Yii::$app->request->get('username');
        if (!filter_input(INPUT_GET, 'username', FILTER_VALIDATE_EMAIL)) {
            return [
                'code' => 1,
                'message' => '邮箱格式不正确'
            ];
        }

        $flash =[
            //'code' => mt_rand(1000, 9999),
            'code' => 1234,
            'username' => $username,
            'type' => 1
        ];
        Yii::$app->session->addFlash("verify_code", $flash);
    }


    public function actionCheckVersion() {
        $clientType = Yii::$app->request->get('client_type');
        $query = AppVersion::find()->orderBy(['create_by' => 'desc'])->limit(1);
        if (!empty($clientType)) {
            $query->andWhere(['client_type' => $clientType]);
        }
        $version = $query->one();
        return $version;
    }

    public function actionFeedback() {
        $post = Yii::$app->request->post();
        if (!Yii::$app->user->isGuest) {
            $post['user_id'] = Yii::$app->user->getId();
        }

        $model = AppFeedBack::getInstance();
        if ($model->load($model, '') && $model->save()) {
            return true;
        }

        return false;
    }

    public function actionAboutUs() {
        Yii::$app->response->format = Response::FORMAT_HTML;
        Yii::$app->response->off('beforeSend');
        return $this->render('about_us');
    }
}