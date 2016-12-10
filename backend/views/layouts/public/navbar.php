<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">

        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                <span class="hidden-xs">
                    用户
                    <i class="fa fa-caret-down"></i>
                </span>
            </a>
            <ul class="dropdown-menu">
                <!-- User image -->
                <li>
                    <?= Html::a('退出', Url::toRoute('/login/logout')) ?>
                </li>

            </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>
    </ul>
</div>