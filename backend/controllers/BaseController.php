<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/1 0001
 * Time: 14:09
 */
namespace backend\controllers;

use backend\models\Menu;
use yii\web\Controller;
use Yii;
use yii\db\Query;

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
            return $this->redirect(['/article/index']);
        }
    }


    public function beforeAction($action)
    {
        $controller = $this->id;
        $action = $this->action->id;
        $currentUrl = strtolower($controller.'/'.$action);
        $this->menus = $this->getMenus($currentUrl);

        if (!$this->checkRule($currentUrl)) {
            return false;
        }
        return true;
    }

    public function getMenus($url)
    {
        $menus = [];
        //获得一级菜单
        $menus['main'] = (new Query())->from(Menu::tableName())
                            ->where(['pid' => 0, 'hide' => 0])
                            ->orderBy('sort ASC')
                            ->all();
        $menus['child'] = [];

        //获得当前点击菜单
        $current = (new Query())->from(Menu::tableName())
                            ->where(['and', 'pid<>0', ['like', 'url', $url]])
                            ->one();

        foreach ($menus['main'] as $key => $item) {
            if (!$this->checkRule($item['url'])) {
                unset($menus['main'][$key]);
                continue;
            }

            if ($item['id'] == $current['pid']) {
                $menus['main'][$key]['class'] = 'active';
                //获得二级菜单
                $submenu = Menu::find()
                                    ->where(['pid' => $item['id'], 'hide' => 0])
                                    ->orderBy('sort ASC')
                                    ->asArray()
                                    ->all();
//var_dump($submenu);die;
                if ($submenu && is_array($submenu)) {
                    foreach ($submenu as $skey => $sub) {
                        if (!$this->checkRule($sub['url'])) {
                            unset($submenu[$skey]);
                            continue;
                        }
                    }

                    foreach ($submenu as $sub) {
                        list($title, $icon) = explode('|', $sub['group']);
                        if (!isset($menus['child'][$title]['name'])) {
                            $menus['child'][$title]['name'] = $title;
                            $menus['child'][$title]['icon'] = $icon;
                        }
                        if ($sub['url'] == $url) {
                            $sub['class'] = 'active';
                            $menus['child'][$title]['class'] = 'active';
                        }
                        $menus['child'][$title]['_child'][] = $sub;
                    }
                }
            }
        }

        return $menus;
    }


    public function checkRule($url)
    {
        if (Yii::$app->params['admin'] == Yii::$app->user->id) {
            return true;
        }

        if (Yii::$app->user->can($url)) {
            return true;
        }

        return false;
    }

}