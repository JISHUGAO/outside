<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
$account = [];
if ($this->context->action->id == 'add-admin') {
    $this->context->contentTitle = '添加管理员';
} else {
    $this->context->contentTitle = '编辑管理员信息';
    $account['disabled'] = true;
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

        <?= $form->field($model, 'account')->textInput(array_merge($account, [
            'class' => 'form-control',
        ]))->label('账号') ?>
        <?= $form->field($model, 'password')->passwordInput([
            'class' => 'form-control'
        ])->label('密码') ?>
        <?= $form->field($model, 'nickname')->textInput([
            'class' => 'form-control'
        ])->label('昵称') ?>

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
