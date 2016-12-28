<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/1 0001
 * Time: 14:14
 */
namespace backend\controllers;

use common\models\User;
use yii\data\ActiveDataProvider;
use Yii;

class UserController extends BaseController
{
    public $defaultAction = 'admin';
    /**
     * 后台用户
     */
    public function actionAdmin()
    {
        $query = User::find()->where(['flag' => 1]);
        $dataProvider = new ActiveDataProvider([
           'query' => $query
        ]);

        return $this->render('admin', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionAddAdmin()
    {
        $model = User::getInstance();
        if (Yii::$app->request->isPost) {
            $model->flag = 1;
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['admin']);
            }
        }
        return $this->render('add_admin', [
            'model' => $model
        ]);
    }

    public function actionEditAdmin()
    {
        $model = User::getInstance(Yii::$app->request->get('id'));
        $model->scenario = User::SCENARIO_EDIT;
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['admin']);
            }
        }
        unset($model['password']);
        return $this->render('add_admin', [
            'model' => $model
        ]);
    }

    public function actionDeleteAdmin()
    {
        $id = Yii::$app->request->get('id');
        if (Yii::$app->params['admin'] == $id) {
            Yii::$app->session->setFlash('error', '超级用户无法删除');
            return $this->redirect(['admin']);
        }
        $mdoel = User::findOne(['id' => $id]);
        if (!$mdoel->delete()) {
            Yii::$app->session->setFlash('error', '删除失败');
        }

        return $this->goBack();
    }

    /**
     * 前台会员列表
     */
    public function actionIndex()
    {

    }


    /**
     * 查看会员资料
     */
    public function actionView()
    {

    }
}