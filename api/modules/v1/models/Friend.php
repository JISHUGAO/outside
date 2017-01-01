<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/29 0029
 * Time: 10:26
 */

namespace api\modules\v1\models;

use common\models\BaseActiveRecord;

class Friend extends BaseActiveRecord
{
    public function getFriendByUserId($userId)
    {
        $query = self::find()->where(['core_friend.user_id' => $userId, 'status' => 1])
            ->joinWith('user')
            ->asArray();
        $users = $query->all();
        $groups = [
            0 => [
                'groupname' => '我的好友',
                'id' => 0
            ]
        ];
        foreach ($users as $userInfo) {
            $user = $userInfo['user'];
            $info = [
                "username" => $user['nickname'], //好友昵称
                "id" => $user['id'], //好友ID
                "avatar" => $user['avatar'], //好友头像
                "sign" => "这些都是测试数据，实际使用请严格按照该格式返回", //好友签名
                "status" => "online" //若值为offline代表离线，online或者不填为在线
            ];
            if (!isset($groups[$userInfo['group_id']])) {
                $friendGroup = new FriendGroup($userInfo['group_id']);
                $groups[$userInfo['group_id']]['groupname'] = $friendGroup->name;
                $groups[$userInfo['group_id']]['id'] = $friendGroup->id;
            }
            $groups[$userInfo['group_id']]['list'][] = $info;
        }

        return $groups;
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'friend_id'])->select('id,nickname,avatar');
    }

}