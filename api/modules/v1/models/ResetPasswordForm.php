<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/16 0016
 * Time: 9:12
 */

namespace api\modules\v1\models;


use common\models\BaseModel;
use Yii;
use common\models\User;

class ResetPasswordForm extends BaseModel
{

    public $username;
    public $code;
    public $password;
    public $repeat_password;

    public function rules()
    {
        return [
            [['username', 'code', 'password', 'repeat_password'], 'required'],
            ['username', 'email', 'message' => '邮箱格式不正确'],
            ['password', 'compare', 'compareAttribute' => 'repeat_password', 'message' => '两次密码输入不一致']
        ];
    }

    public function save()
    {
        if ($this->validate()) {
            $user = User::find()->where(['account' => $this->username])->one();

            if ($user) {
                $flash = Yii::$app->session->getFlash('verify_code');
                if (!isset($flash[0]['code']) || $flash[0]['code'] != $this->code) {
                    $this->addError('code', '验证码错误');
                    return false;
                }
                $password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
                Yii::$app->db->createCommand()->update('core_user', ['password' => $password], ['id' => $user['id']])->execute();
                return true;
            }

            $this->addError('username', '账号不存在');
        }
        return false;
    }

}