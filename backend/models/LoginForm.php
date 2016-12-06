<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/5 0005
 * Time: 16:26
 */
namespace backend\models;

use yii\base\Model;
use Yii;

class LoginForm extends Model
{
    public $username;
    public $pwd;

    private $_user;

    public function rules()
    {
        return [
            [['username', 'pwd'], 'required', 'message' => '账号或密码不能为空'],
            ['pwd', 'validatePassword']
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->pwd)) {
                $this->addError($attribute, '密码错误');
            }
        }
    }

    public function getUser()
    {
        if ($this->_user == null) {
            $this->_user = User::findByAccount($this->username);
        }
        return $this->_user;
    }

    public function login()
    {
        if ($this->validate()) {
            $result = Yii::$app->user->login($this->getUser());
            return $result;
        } else {
            return false;
        }
    }
}