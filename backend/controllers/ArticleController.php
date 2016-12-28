<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/12 0012
 * Time: 10:32
 */

namespace backend\controllers;

use Yii;
use common\models\Article;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;

class ArticleController extends BaseController
{
    /**
     * 文章
     */
    public function actionIndex()
    {
        $query = Article::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => Yii::$app->params['pageSize'],
            ],
            'sort' => [
                'defaultOrder' => [
                    'sort' => 'asc',
                    'create_by' => 'desc'
                ]
            ]
        ]);

        return $this->render('article', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionDelete()
    {
        $article = new Article();
        $id = \Yii::$app->request->get('id');
        if ($article::deleteAll(['id' => $id])) {
            //$this->redirect(['/content/article']);
            $this->goBack();
        }
    }

    public function actionEdit()
    {
        $id = Yii::$app->request->get('id');
        $model = Article::find()->where(['id' => $id])->one();
        $model->scenario = Article::SCENARIO_EDIT;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post('Article');
            $cover = UploadedFile::getInstance($model, 'cover');
            if ($cover != null) {
                $webroot = Yii::getAlias('@webroot');
                $cover->saveAs($webroot.'/Uploads/'.$cover->baseName.'.'.$cover->extension);
                $post['cover'] = Yii::getAlias('@web').'/Uploads/'.$cover->baseName.'.'.$cover->extension;
            }

            if ($model->load($post, '') && $model->save()) {
                return $this->redirect(['/content/article']);
            }
        }
        return $this->render('add_article', [
            'model' => $model
        ]);
    }

    public function actionAdd()
    {
        $model = new Article(['scenario' => Article::SCENARIO_ADD]);
        $model->loadDefaultValues();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post('Article');
            $cover = UploadedFile::getInstance($model, 'cover');
            $webroot = Yii::getAlias('@webroot');
            $cover->saveAs($webroot.'/Uploads/'.$cover->baseName.'.'.$cover->extension);
            $post['cover'] = Yii::getAlias('@web').'/Uploads/'.$cover->baseName.'.'.$cover->extension;
            if ($model->load($post, '') && $model->save()) {
                return $this->redirect(['/content/article']);
            }
        }


        return $this->render('add_article', [
            'model' => $model
        ]);
    }
}