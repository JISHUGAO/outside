<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/1 0001
 * Time: 14:09
 */
namespace backend\controllers;

use Yii;

class MainController extends BaseController
{

    public $contentTitle;
    public $subhead;
    public function actionIndex()
    {
        $view = Yii::$app->view;
        $view->params['contentTitle'] = '首页';
        $view->params['subhead'] = '副首页';
        return $this->render('index', [
            'contentTitle' => '主标题',
            'subhead' => '副标题'
        ]);
    }
}