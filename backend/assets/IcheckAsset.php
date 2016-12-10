<?php
namespace backend\assets;

use yii\web\AssetBundle;

class IcheckAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/static';
    public $css = [
        'libs/iCheck/all.css'
    ];

    public $js = [
        'libs/iCheck/'.(YII_ENV_DEV ? 'icheck.js' : 'icheck.min.js')
    ];

    public $depends = [
        'backend\assets\AdminAsset'
    ];
}