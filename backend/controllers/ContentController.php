<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/5 0005
 * Time: 11:44
 */
namespace backend\controllers;

use common\models\Article;
use common\models\Category;
use League\FactoryMuffin\Exceptions\ModelException;
use yii\data\ActiveDataProvider;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class ContentController extends BaseController
{

    /**
     * 文章
     */
    public function actionArticle()
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

    public function actionDeleteArticle()
    {
        $article = new Article();
        $id = \Yii::$app->request->get('id');
        if ($article::deleteAll(['id' => $id])) {
           //$this->redirect(['/content/article']);
            $this->goBack();
        }
    }

    public function actionEditArticle()
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

    public function actionAddArticle()
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

    /**
     * 分类
     */
    public function actionCategory()
    {
        $query = Category::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => Yii::$app->params['pageSize']
            ]
        ]);

        return $this->render('/category/index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionAddCategory()
    {
        $model = Category::getInstance();
        $model->loadDefaultValues();
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['/content/category']);
            }
        }

        return $this->render('/category/add', [
            'model' => $model
        ]);
    }

    public function actionEditCategory()
    {
        $model = Category::getInstance(Yii::$app->request->get('id'));
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['/content/category']);
            }
        }
        return $this->render('/category/add', [
            'model' => $model
        ]);
    }

    public function actionDeleteCategory()
    {
        $model = Category::getInstance(Yii::$app->request->get('id'));
        if ($model->delete()) {
            $this->goBack(Yii::$app->request->getReferrer());
        } else {
            throw new ModelException('操作失败');
        }
    }

    public function getArticle($id = 0)
    {
        if ($id === 0) {
            return new Article();
        }

        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('未发现请求的记录');
        }
    }

}