<?php
use yii\helpers\Url;

?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">主菜单</li>
            <?php if (!empty($this->context->menus['child']) && is_array($this->context->menus['child'])) { ?>
            <?php foreach ($this->context->menus['child'] as $menu) { ?>
                <li class="<?= isset($menu['class']) ? $menu['class'] : '' ?> treeview">
                    <a href="#">
                        <i class="<?= $menu['icon'] ?>"></i>
                        <span><?= $menu['name'] ?></span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <?php if (!empty($menu['_child']) && is_array($menu['_child'])) { ?>

                    <ul class="treeview-menu">
                        <?php foreach ($menu['_child'] as $v) { ?>
                        <li <?= isset($v['class']) ? 'class="'.$v['class'].'"' : '' ?>><a href="<?= Url::toRoute($v['url']) ?>"><i class="fa fa-circle-o"></i> <?= $v['title'] ?></a></li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </li>
            <?php } ?>
            <?php } ?>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>