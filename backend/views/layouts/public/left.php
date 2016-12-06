<?php
use yii\helpers\Url;

?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">主菜单</li>
            <?php if (!empty($this->context->menus) && is_array($this->context->menus)) { ?>
            <?php foreach ($this->context->menus as $menu) { ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-files-o"></i>
                        <span><?= $menu['name'] ?></span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <?php if (!empty($menu['child']) && is_array($menu['child'])) { ?>

                    <ul class="treeview-menu">
                        <?php foreach ($menu['child'] as $v) { ?>
                        <li><a href="<?= Url::toRoute($v['url']) ?>"><i class="fa fa-circle-o"></i> <?= $v['title'] ?></a></li>
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