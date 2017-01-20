<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/22 0022
 * Time: 14:22
 */

namespace api\modules\v1\controllers;

use api\modules\v1\models\Article;
use common\models\ArticleComment;
use common\models\UserCollection;
use Yii;
use api\utils\Pagination;

class ArticleController extends BaseController
{
    public function actionList()
    {
        $category = Yii::$app->request->get('category', 0);
        $keyword = Yii::$app->request->get('search');
        $article = Article::getInstance();
        $query = $article::find()->orderBy('create_by DESC, sort ASC')->select('id,title,description,create_by,cover,source_name');
        if (!empty($category)) {
            $query->andWhere(['category_id' => $category]);
        }
        if (!empty($keyword)) {
            $query->andWhere(['like', 'title', $keyword]);
        }

        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $articles = $query->offset($pagination->offset)->limit($pagination->limit)->all();

        return [
            'totalCount' => $count,
            'size' => Yii::$app->params['page.size'],
            'items' => $articles
        ];
    }


    public function actionDetail()
    {
        $id = Yii::$app->request->get('id');
        $article = Article::getInstance($id);
        $article = $article->toArray();
        $article['is_collected'] = false;
        if (!Yii::$app->user->isGuest) {
            $article['is_collected'] = UserCollection::isArticleCollectedByUser(Yii::$app->user->id, $id);
        }
//var_dump($article);die;
        return $article;
    }
}