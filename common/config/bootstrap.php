<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@api', dirname(dirname(__DIR__)) . '/api');

//前后端url
Yii::setAlias('@backendUrl', 'http://backend.localhost.gaoweisong.com');
Yii::setAlias('@frontendUrl', 'http://test.localhost.vue.com');
Yii::setAlias('@apiUrl', 'http://api.localhost.gaoweisong.com');
Yii::setAlias('@staticUrl', 'http://static.localhost.gaoweisong.com');