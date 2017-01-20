<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@api', dirname(dirname(__DIR__)) . '/api');
Yii::setAlias('@static', dirname(dirname(__DIR__)) . '/resources/static');
Yii::setAlias('@staticImage', dirname(dirname(__DIR__)) . '/resources/static/img');

//前后端url
if (YII_DEBUG) {
    Yii::setAlias('@backendUrl', 'http://backend.localhost.gaoweisong.com');
    Yii::setAlias('@frontendUrl', 'http://test.localhost.vue.com');
    Yii::setAlias('@apiUrl', 'http://api.localhost.gaoweisong.com');
    Yii::setAlias('@staticUrl', 'http://static.localhost.gaoweisong.com');
    Yii::setAlias('@staticUrlImage', 'http://static.localhost.gaoweisong.com/img');
} else {
    Yii::setAlias('@backendUrl', 'http://backend.gaoweisong.com');
    Yii::setAlias('@frontendUrl', 'http://www.gaoweisong.com');
    Yii::setAlias('@apiUrl', 'http://api.gaoweisong.com');
    Yii::setAlias('@staticUrl', 'http://static.gaoweisong.com');
}

