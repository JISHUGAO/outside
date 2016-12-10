<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/6 0006
 * Time: 13:58
 */

namespace common\models;


class Article extends BaseActiveRecord
{
    const SCENARIO_ADD = 'add';
    const SCENARIO_EDIT = 'edit';

    public static function tableName()
    {
        return '{{%article}}';
    }

    public function rules()
    {
        return [
            [['title', 'category_id', 'cover', 'description', 'content', 'sort'], 'required', 'on' => self::SCENARIO_ADD],
            [['title', 'category_id', 'description', 'content', 'sort'], 'required', 'on' => self::SCENARIO_EDIT],
            ['cover', 'file']
        ];
    }

    public function scenarios()
    {
        $fields = ['title', 'category_id', 'cover', 'description', 'content', 'sort'];
        return [
            self::SCENARIO_ADD => $fields,
            self::SCENARIO_EDIT => $fields
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function afterValidate()
    {
        parent::afterValidate();
        $this->create_by = time();
        return true;
    }

}