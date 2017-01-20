<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/19 0019
 * Time: 8:17
 */

namespace common\models;


class UserMessage extends BaseActiveRecord
{
    const STATE_UNREAD = 0;
    const STATE_READ = 1;
    public static function tableName()
    {
        return '{{%user_message}}';
    }

    public static function getUnreadCountByUserId($userId)
    {
        $where = [
            'user_id' => $userId,
            'is_read' => self::STATE_UNREAD
        ];
        return self::find()->where($where)->count();
    }
}