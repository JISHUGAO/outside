<?php
use yii\helpers\Html;
use backend\assets\AdminAsset;
use yii\helpers\Url;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->language ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>登录</title>
    <?php $this->head() ?>
    <style>
        body {
            background-image:url('<?= Url::to("/static/image/background.jpg") ?>') !important;
            -moz-background-size: 100% 100% !important; /*  Firefox 3.6 */
            -o-background-size: 100% 100% !important;;/* Opera 9.5 */
            -webkit-background-size: 100% 100% !important;;/* Safari 3.0 */
            background-size: 100% 100% !important;;/*  Firefox 4.0 and other CSS3-compliant browsers */
            -moz-border-image: url('<?= Url::to("/static/image/background.jpg") ?>') 0 !important;; /* Firefox 3.5 */
            filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='scale.jpg', sizingMethod='scale') !important;;/* for < ie9 */
           
        }
    </style>
</head>
<body class="hold-transition login-page">
<?php $this->beginBody() ?>
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><?= Html::decode(Yii::$app->params['name']) ?>管理系统</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"></p>

        <form action="<?= Url::current() ?>" method="post">
            <div class="form-group has-feedback">
                <input type="text" name="info[username]" class="form-control" placeholder="账号">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div>
                <?= isset($username) ? $username[0] : '' ?>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="info[pwd]" class="form-control" placeholder="密码">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <?= isset($pwd) ? $pwd[0] : '' ?>
            <div class="row">

                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
                </div>
                <!-- /.col -->
            </div>
        </form>



    </div>
    <!-- /.login-box-body -->
</div>
<?php $this->endBody() ?>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
<?php $this->endPage() ?>
