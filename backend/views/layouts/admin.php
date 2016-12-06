<?php
use backend\assets\AdminAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AdminAsset::register($this);
//$this->contentTitle = '内容管理';
//$this->subhead = '';
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><?= Yii::$app->params['name'] ?></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="<?= Url::toRoute('/content/article') ?>">内容</a></li>
                        <li><a href="<?= Url::toRoute('user/index') ?>">用户</a></li>
                        <li><a href="<?= Url::toRoute('system/config') ?>">系统</a></li>
                    </ul>

                    <?= $this->render('public/navbar') ?>
                </div>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <?= $this->render('/layouts/public/left') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                内容管理
                <small>副标题</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
                <li class="active">内容管理</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
           <?= $content ?>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.7
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </footer>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>