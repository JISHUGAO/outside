<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/22 0022
 * Time: 13:33
 */
namespace api\modules\v1\controllers;

use api\modules\v1\models\Category;
use Yii;


class CategoryController extends BaseController
{
    public function actionAll()
    {
        $all = Category::find()->orderBy('sort ASC')->where(['is_show' => 1])->asArray()->all();
        //var_dump($all);die;
        return $all;
    }

}