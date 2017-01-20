<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/24 0024
 * Time: 16:21
 */

namespace api\modules\v1\controllers;

use common\models\AppFeedBack;
use common\models\ArticleComment;
use common\models\User;
use Yii;
use api\utils\Pagination;

class CommentController extends BaseController
{

    public function actionPush()
    {
        if (Yii::$app->user->isGuest) {
            return [
                'code' => 1,
                'message' => '未登录'
            ];
        }
        $articleComment = new ArticleComment();
        $post = Yii::$app->request->post();
        $post['user_id'] = Yii::$app->user->getId();
        if ($articleComment->load($post, '') && $articleComment->save()) {
            return [];
        }
        return [
            'code' => 1,
            'message' => $articleComment->getFirstErrorMessage()
        ];
    }

    public function actionList()
    {
        $articleId = Yii::$app->request->get('article_id');
        $articleComment = ArticleComment::getInstance();
        $query = $articleComment::find()->orderBy(ArticleComment::tableName().'.create_by DESC')
            ->where(['article_id' => $articleId])
            ->innerJoinWith('user')
            ->asArray();

        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $comments = $query->offset($pagination->offset)->limit($pagination->limit)->all();

        //echo $query->createCommand()->getRawSql();die;
        return [
            'totalCount' => (int)$count,
            'size' => Yii::$app->params['page.size'],
            'items' => $comments
        ];
    }


}