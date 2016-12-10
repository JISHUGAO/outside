<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

if ($this->context->action->id == 'add-category') {
    $this->context->contentTitle = '添加分类';
} else {
    $this->context->contentTitle = '编辑分类';
}

?>
<div class="box box-info">
    <div class="box-header"></div>
    <?php $form = ActiveForm::begin([
        'options' => [
            'class' => 'form-horizontal'
        ],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-sm-10\">{input}</div>\n",
            'labelOptions' => [
                'class' => 'col-sm-2 control-label'
            ]
        ],
    ]) ?>
    <div class="box-body">

        <?= $form->field($model, 'name')->textInput([
            'class' => 'form-control'
        ])->label('标题') ?>
        <?= $form->field($model, 'sort')->textInput(['type' => 'number'])->label('排序') ?>
    </div>

    <div class="box-footer with-border">
        <?= Html::submitButton('确定', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>

