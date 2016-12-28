<?php
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->context->contentTitle = $this->title = '管理员信息';

?>
<?php if (Yii::$app->session->hasFlash('error')): ?>
<div class="alert alert-danger alert-dismissible" id="alert-window">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <?= Yii::$app->session->getFlash('error') ?>
</div>
<?php endif; ?>
<div class="box">
    <div class="box-header with-border">
        <div class="box-title">管理信息</div>
        <div class="box-tools">
            <a href="<?= Url::toRoute(['add-admin']) ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>添加管理员</a>
        </div>

    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-xs-12">
                <!-- 搜索 -->
            </div>
        </div>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'header' => 'ID',
                    'attribute' => 'id'
                ],
                [
                    'header' => '账号',
                    'attribute' => 'account'
                ],
                [
                    'header' => '创建时间',
                    'attribute' => 'create_by',
                    'content' => function($model) {
                            return $model->create_by > 0 ? date('Y-m-d H:i:s', $model->create_by) : '';
                    }
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'template' => '{edit-admin}{delete-admin}',
                    'buttons' => [
                        'edit-admin' => function($url, $model, $key) {
                            return Html::a('<i class="fa fa-edit"></i>', $url, [
                                'class' => 'btn btn-primary btn-xs'
                            ]).' ';
                        },
                        'delete-admin' => function($url, $model, $key) {
                            return Html::a('<i class="fa fa-close"></i>', $url, [
                                'class' => 'btn btn-danger btn-xs'
                            ]);
                        }
                    ]
                ]
            ],
            'layout' => '{items}<div class="row"><div class="col-xs-5">{summary}</div><div class="col-xs-7 text-right">{pager}</div></div>',
            'pager' => [
                'options' => [
                    'style' => 'margin:0px;',
                    'class' => 'pagination',
                ]
            ],
            'emptyText' => '什么都没有',
            'emptyTextOptions' => [
                'class' => 'text-center'
            ],
            'summary' => '共{totalCount}条数据, 每页显示{count}条',

        ])?>
    </div>
    <div class="box-footer">

    </div>
</div>
<?php
\backend\assets\IcheckAsset::register($this);
?>
<?php $this->beginBlock('contentScript') ?>
<script>
    $(function(){
        setTimeout(function(){
            $('#alert-window').slideUp();
        }, 3000);
    })
</script>
<?php $this->endBlock('contentScript') ?>

