<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

if ($this->context->action->id == 'add') {
    $this->context->contentTitle = '添加';
} else {
    $this->context->contentTitle = '修改';
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

        <?= $form->field($model, 'version_code')->textInput([
            'class' => 'form-control'
        ])->label('版本号') ?>

        <?= $form->field($model, 'version_name')->textInput([
            'class' => 'form-control'
        ])->label('版本名称') ?>

        <?= $form->field($model, 'client_type')->dropDownList(ArrayHelper::map(
            [['id' => 1, 'name' => '安卓']],
            'id',
            'name'
        ),[
            'class' => 'form-control'
        ])->label('客户端类型') ?>
        <?= $form->field($model, 'download_url')->fileInput()->label('上传安装包') ?>
        <?= $form->field($model, 'change_log')->textarea(['class' => 'form-control', 'rows' => 10])->label('更新记录') ?>
    </div>

    <div class="box-footer with-border">
        <?= Html::submitButton('确定', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>
<?php $this->beginBlock('contentScript') ?>
<?php
\backend\assets\CkeditorAsset::register($this);
?>
<script>
$(function(){
    CKEDITOR.replace('ckeditor');
})
</script>
<?php $this->endBlock('contentScript') ?>
