<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/5 0005
 * Time: 16:02
 */
namespace backend\controllers;

use backend\models\LoginForm;
use yii\web\controller;
use Yii;
use yii\helpers\Json;

class LoginController extends Controller
{
    public $layout = false;
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $error = [];
        if (Yii::$app->request->isPost) {
            $loginForm = new LoginForm();
            if ($loginForm->load(Yii::$app->request->post(), 'info') && $loginForm->login()) {
                return $this->redirect(['content/article']);
            } else {
                $error = $loginForm->getErrors();
            }
        }

        return $this->render('index', $error);
    }
}