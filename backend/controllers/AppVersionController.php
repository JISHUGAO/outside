<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/18 0018
 * Time: 8:36
 */

namespace backend\controllers;


use common\models\AppVersion;
use yii\data\ActiveDataProvider;
use Yii;
use yii\web\UploadedFile;

class AppVersionController extends BaseController
{
    public function actionList()
    {
        $query = AppVersion::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => Yii::$app->params['pageSize'],
            ],
            'sort' => [
                'defaultOrder' => [
                    'create_by' => 'desc'
                ]
            ]
        ]);

        return $this->render('list', [
            'dataProvider' => $dataProvider
        ]);
    }




    public function actionAdd()
    {
        $model = new AppVersion();
        $model->loadDefaultValues();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post('AppVersion');
            $apk = UploadedFile::getInstance($model, 'download_url');
            $webroot = Yii::getAlias('@static');
            $path = '/apk/gavin-gao'.$post['version_code'].date('ymd', time()).'.'.$apk->extension;
            $apk->saveAs($webroot . $path);
            $post['download_url'] = Yii::getAlias('@staticUrl').$path;
            //var_dump($post);die;
            if ($model->load($post, '') && $model->save()) {
                return $this->redirect(['/app-version/list']);
            }
        }


        return $this->render('add', [
            'model' => $model
        ]);
    }

}