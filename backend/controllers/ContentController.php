<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/5 0005
 * Time: 11:44
 */
namespace backend\controllers;

class ContentController extends BaseController
{

    /**
     * 文章
     */
    public function actionArticle()
    {
        return $this->render('article');
    }

    /**
     * 分类
     */
    public function actionCategory()
    {

    }
}