<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/26 0026
 * Time: 18:19
 */

namespace common\models;


class ArticleComment extends BaseActiveRecord
{
    public function rules()
    {
        return [
          [['content', 'article_id', 'user_id'], 'required']
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->create_by = time();
        }
        return parent::beforeSave($insert);
    }
}