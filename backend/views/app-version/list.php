<?php
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->context->contentTitle = $this->title = '版本管理';

?>
<?php $form = ActiveForm::begin([
    'action' => URL::toRoute(['app-version/delete']),
    'method' => 'get'
]) ?>
<div class="box box-info">
    <div class="box-header with-border">
        <div class="box-title">管理信息</div>
        <div class="box-tools">
            <a href="<?= Url::toRoute(['app-version/add']) ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> 发布新版本</a>

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
                    'class' => 'yii\grid\CheckboxColumn',
                    'name' => 'id',
                    'header' => '<input type="checkbox" id="checkAll"/>'
                ],
                [
                    'header' => 'ID',
                    'attribute' => 'id'
                ],
                [
                    'header' => '版本号',
                    'attribute' => 'version_code'
                ],
                [
                    'header' => '版本名称',
                    'attribute' => 'version_name'
                ],
                [
                    'header' => '类型',
                    'attribute' => 'client_type',
                    'content' => function($model) {
                        return $model->client_type == 1 ? "安卓" : '苹果';
                    }
                ],
                [
                    'header' => '更新时间',
                    'attribute' => 'create_by',
                    'content' => function($model) {
                        return $model->create_by <= 0 ? '' : date('Y-m-d H:i:s', $model->create_by);
                    }
                ],
                /*[
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'template' => '{edit}{delete}',
                    'buttons' => [
                        'edit' => function($url, $model, $key) {
                            return Html::a('<i class="fa fa-edit"></i>', $url, [
                                'class' => 'btn btn-primary btn-xs'
                            ]).' ';
                        },
                        'delete' => function($url, $model, $key) {
                            return Html::a('<i class="fa fa-close"></i>', $url, [
                                'class' => 'btn btn-danger btn-xs'
                            ]);
                        }
                    ]
                ]*/
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
<?php $form->end() ?>
<?php
\backend\assets\IcheckAsset::register($this);
?>

