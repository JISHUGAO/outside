<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <?php
                if (isset($this->context->menus['main']) && is_array($this->context->menus['main'])):
                    ?>
                    <?php
                    foreach ($this->context->menus['main'] as $menus):
                        ?>
                        <li <?= isset($menus['class']) ? 'class="'.$menus['class'].'"' : '' ?>><a href="<?= Url::toRoute($menus['url']) ?>"><?= $menus['title'] ?></a></li>
                    <?php endforeach; ?>

                <?php endif; ?>
            </ul>

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

                </ul>
            </div>
        </div>
    </div>

</nav>