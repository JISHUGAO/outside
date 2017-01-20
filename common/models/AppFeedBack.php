<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/18 0018
 * Time: 16:30
 */

namespace common\models;


class AppFeedBack extends BaseActiveRecord
{
    public static function tableName()
    {
        return 'app_feedback';
    }

    public function rules() {
        return [
            [['user_id', 'content', 'client_type', 'client_version'], 'safe']
        ];
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->create_by = time();
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}