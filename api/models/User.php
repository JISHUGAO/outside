<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/22 0022
 * Time: 15:44
 */

namespace api\models;

use common\models\User as BaseUser;

class User extends BaseUser
{
    public $repeatPassword;

    public function rules()
    {
        $rules =  parent::rules(); // TODO: Change the autogenerated stub
        return array_merge($rules, [
            ['repeatPassword', 'validateEqual']
        ]);
    }

    public function validateEqual($attribute, $params)
    {
        if ($this->attributes[$attribute] !== $this->attributes['password']) {
            $this->addError($attribute, '两次输入密码不一致');
        }
    }

    public function attributes()
    {
        $attributes = parent::attributes();
        $attributes[] = 'repeatPassword';
        return $attributes;
    }


    public static function findIdentity($id)
    {
        return static::findOne([
            'id' => $id
        ]);
    }

}