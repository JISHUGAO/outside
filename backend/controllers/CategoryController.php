<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/12 0012
 * Time: 10:35
 */
namespace backend\controllers;

use common\models\Category;
use League\FactoryMuffin\Exceptions\ModelException;
use yii\data\ActiveDataProvider;
use Yii;

class CategoryController extends BaseController
{

    /**
     * 分类
     */
    public function actionIndex()
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

    public function actionAdd()
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

    public function actionEdit()
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

    public function actionDelete()
    {
        $model = Category::getInstance(Yii::$app->request->get('id'));
        if ($model->delete()) {
            $this->goBack(Yii::$app->request->getReferrer());
        } else {
            throw new ModelException('操作失败');
        }
    }
}