<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/12 0012
 * Time: 10:43
 */

namespace backend\models;

class Menu extends \common\models\BaseActiveRecord
{
    public static function tableName()
    {
        return '{{%menu}}';
    }
}