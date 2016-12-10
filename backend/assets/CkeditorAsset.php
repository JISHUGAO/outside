<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/8 0008
 * Time: 14:33
 */

namespace backend\assets;


class CkeditorAsset extends \yii\web\AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/static';

    public $js = [
        'libs/ckeditor/ckeditor.js'
    ];
}