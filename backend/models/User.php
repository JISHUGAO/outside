<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/5 0005
 * Time: 16:51
 */
namespace backend\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Yii;

class User extends ActiveRecord implements IdentityInterface
{
    const Admin_USER_FLAG = 1;
    const NORMAL_USER_FLAG = 0;
    public static function tableName()
    {
        return '{{%user}}';
    }
    public static function findIdentity($id)
    {
        return static::findOne([
            'id' => $id,
            'flag' => self::Admin_USER_FLAG
        ]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    public static function findByAccount($account)
    {
        return static::findOne([
            'account' => $account,
            'flag' => self::Admin_USER_FLAG
        ]);
    }

    public function validatePassword($password)
    {
        //return Yii::$app->getSecurity()->validatePassword($password, $this->password);
        return $password == $this->password ? true : false;
    }
}