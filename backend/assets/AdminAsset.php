<?php
namespace backend\assets;

use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/static';
    public $css = [
        'css/bootstrap.css',
        'css/AdminLTE.css',
        'css/skins/_all-skins.min.css',
        'css/font-awesome.min.css'
    ];
    public $js = [
        'libs/jQuery/jquery-2.2.3.min.js',
        'js/bootstrap.js',
        'js/app.js',
        'js/common.js'
    ];
    public $depends = [
       // 'yii\web\YiiAsset',
       // 'yii\bootstrap\BootstrapAsset',
    ];
}