<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/24 0024
 * Time: 16:22
 */

namespace api\modules\v1\controllers;

use Yii;
use api\models\User;
use common\models\LoginForm;

class UserController extends BaseController
{
    /**
     *  注册
     */
    public function actionRegister()
    {
        $userInfo = [];
        if (Yii::$app->request->isPost) {
            $user = new User();
            $user->scenario = User::SCENARIO_ADD;
            $post = Yii::$app->request->post();
            if ($user->load($post, '')) {
                $result = $user->save();
                if (!$result) {
                    return [
                        'code' => 1,
                        'data' => $user->errors
                    ];
                } else {
                    $loginForm = new LoginForm();
                    $loginForm->load([
                        'username' => $post['account'],
                        'pwd' => $post['password']
                    ], '');
                    if ($result = $loginForm->login()) {
                        $userInfo = $loginForm->getUser();
                    }
                }
            }
        }

        return $userInfo;
    }

    /**
     * 登录
     */
    public function actionLogin()
    {
        $userInfo = [];
        if (Yii::$app->request->isPost) {
            $loginForm = new LoginForm();
            $post = Yii::$app->request->post();
            if ($loginForm->load(['username' => $post['account'], 'pwd' => $post['pwd']], '')) {
                if ($result = $loginForm->login()) {
                    $userInfo = $loginForm->getUser();
                } else {
                    return [
                        'code' => 1,
                        'data' => $loginForm->errors
                    ];
                }
            }
        }

        return $userInfo;
    }

    /**
     * 退出
     */
    public function actionLogout()
    {

    }

}