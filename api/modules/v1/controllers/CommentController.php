<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/24 0024
 * Time: 16:21
 */

namespace api\modules\v1\controllers;

use common\models\ArticleComment;
use common\models\User;
use Yii;
use api\utils\Pagination;

class CommentController extends BaseController
{

    public function actionPush()
    {
        $articleComment = new ArticleComment();
        if ($articleComment->load(Yii::$app->request->post(), '') && $articleComment->save()) {
            return [];
        }
        return [
            'code' => 1,
            'data' => $articleComment->getErrors()
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