<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/14 0014
 * Time: 16:12
 */

namespace common\models;


use yii\base\Model;

class BaseModel extends Model
{
    public function getFirstErrorMessage() {
        $errors = $this->getFirstErrors();
        if (empty($errors)) {
            return "";
        }
        return reset($errors);
    }
}