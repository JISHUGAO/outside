<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/29 0029
 * Time: 10:18
 */

namespace api\modules\v1\models;

use common\models\BaseActiveRecord;

class User extends BaseActiveRecord
{
    public function getInfo($userId)
    {
        $info = self::find()->where(['id' => $userId])->one();
        return [
            "username" => $info['nickname'], //我的昵称
            "id" => $info['id'], //我的ID
            "status" =>"online", //在线状态 online：在线、hide：隐身
            "sign" => "在深邃的编码世界，做一枚轻盈的纸飞机", //我的签名
            "avatar" => $info['avatar'] //我的头像
        ];
    }
}