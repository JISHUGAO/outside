<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/6 0006
 * Time: 14:13
 */

namespace common\models;


class Category extends BaseActiveRecord
{
    public static function tableName()
    {
        return '{{%category}}';
    }

    public function rules()
    {
        return [
            [['name', 'sort'], 'required']
        ];
    }

    public static function getInstance($id = 0)
    {
        if ($id === 0) {
            return new static();
        }

        if (($model = static::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('未发现请求的记录');
        }
    }
}