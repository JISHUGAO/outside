<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/22 0022
 * Time: 14:22
 */

namespace api\modules\v1\controllers;

use api\modules\v1\models\Article;
use Yii;
use api\utils\Pagination;

class ArticleController extends BaseController
{
    public function actionList()
    {
        $category = Yii::$app->request->get('category', 0);
        $article = Article::getInstance();
        $query = $article::find()->orderBy('create_by DESC, sort ASC')->select('id,title,description');
        if (!empty($category)) {
            $query->andWhere(['category_id' => $category]);
        }

        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $articles = $query->offset($pagination->offset)->limit($pagination->limit)->all();

        return [
            'totalCount' => (int)$count,
            'size' => Yii::$app->params['page.size'],
            'items' => $articles
        ];
    }


    public function actionDetail()
    {
        $id = Yii::$app->request->get('id');
        $article = Article::getInstance($id);
        return $article;
    }
}