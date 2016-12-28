<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/5 0005
 * Time: 16:02
 */
namespace backend\controllers;

use common\models\LoginForm;
use yii\web\controller;
use Yii;
use common\models\User;

class LoginController extends Controller
{
    public $layout = false;
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $error = [];
        if (Yii::$app->request->isPost) {
            $loginForm = new LoginForm();
            if ($loginForm->load(Yii::$app->request->post(), 'info') && $loginForm->login()) {
                return $this->gohome();
            } else {
                $error = $loginForm->getErrors();
            }
        }
        var_dump($error);
        return $this->render('index', $error);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['/login/index']);
    }
}