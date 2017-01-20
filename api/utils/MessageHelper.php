<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/11 0011
 * Time: 20:45
 */
namespace api\utils;

use Yii;

class MessageHelper
{
    public static function get($name)
    {
        $errorMsg = Yii::$app->params['errorMsg'];
        return $errorMsg[$name] == null ? "" : $errorMsg[$name];
    }
}