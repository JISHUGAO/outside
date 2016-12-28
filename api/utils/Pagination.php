<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/23 0023
 * Time: 16:20
 */
namespace api\utils;

use yii\data\Pagination as BasePagination;
use Yii;

class Pagination extends BasePagination
{
    public function init()
    {
        $this->defaultPageSize = Yii::$app->params['page.size'];
    }
}
