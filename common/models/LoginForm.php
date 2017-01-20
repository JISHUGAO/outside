<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/5 0005
 * Time: 16:26
 */
namespace common\models;

use yii\base\Model;
use Yii;
use common\models\User;

class LoginForm extends BaseModel
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

    public function getUser($flag = null)
    {
        if ($this->_user == null) {
            $this->_user = User::findByAccount($this->username, $flag);
        }
        return $this->_user;
    }

    public function login($flag = User::NORMAL_USER_FLAG)
    {
        if ($this->validate()) {
            $result = Yii::$app->user->login($this->getUser($flag));
            return $result;
        } else {
            return false;
        }
    }
}