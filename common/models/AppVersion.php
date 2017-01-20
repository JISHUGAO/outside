<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/18 0018
 * Time: 8:38
 */

namespace common\models;


class AppVersion extends BaseActiveRecord
{
    public static function tableName()
    {
        return "app_version";
    }

    public function delete()
    {
        $this->is_delete = 1;
        return $this->save();
    }

    public static function find()
    {
        return parent::find()->andWhere(['is_delete' => 0]);
    }

    public function rules()
    {
        return [
            [['version_code', 'version_name', 'client_type', 'download_url', 'change_log'], 'safe']
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