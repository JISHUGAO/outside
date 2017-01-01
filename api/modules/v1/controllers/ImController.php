<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/29 0029
 * Time: 10:01
 */

namespace api\modules\v1\controllers;

use api\modules\v1\models\Friend;
use Yii;
use api\modules\v1\models\User;

class ImController extends BaseController
{
    public function actionInit()
    {
        $userId = Yii::$app->request->get('id', 1);
        $User = new User();
        $mine = $User->getInfo($userId);

        $Friend = new Friend();
        $friends = $Friend->getFriendByUserId($userId);

        return [
            'mine' => $mine,
            'friend' => $friends,
            //'group' => $groups
        ];
    }

}