<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/1 0001
 * Time: 14:09
 */
namespace backend\controllers;

use yii\web\Controller;
use Yii;

class BaseController extends Controller
{
    public $layout = 'admin';

    public $menus;

    public $contentTitle;
    public $subhead;

    public function init()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/login/index']);
        }
       if ('main' == $this->id) {
            return $this->redirect(['/content/article']);
        }
    }


    public function beforeAction($action)
    {
        $controllerName = $this->id;
        $this->menus = $this->getMenu($controllerName);
        //var_dump($this->menus);die;
        return true;
    }

    public function getMenu($controllerName)
    {
        $children = [
            'main' => '',
            'content' => [
                 [
                     'name' => '文章管理',
                     'icon' => '',
                     'child' => [
                         [
                             'url' => 'content/article',
                             'title' => '文章管理'
                         ],
                         [
                             'title' => '分类管理',
                             'url' => 'content/category'
                         ]
                     ]
                 ]
              ],
              'user' => [

              ]
        ];

        return $children[strtolower($controllerName)];
    }


}