<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

if ($this->context->action->id == 'add-article') {
    $this->context->contentTitle = '添加文章';
} else {
    $this->context->contentTitle = '编辑文章';
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

        <?= $form->field($model, 'title')->textInput([
            'class' => 'form-control'
        ])->label('标题') ?>

        <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(
            \common\models\Category::find()->asArray()->all(),
            'id',
            'name'
        ),[
            'class' => 'form-control'
        ])->label('分类') ?>
        <?= $form->field($model, 'cover')->fileInput()->label('封面图片') ?>
        <?= $form->field($model, 'description')->textarea(['class' => 'form-control'])->label('描述') ?>
        <?= $form->field($model, 'content')->textarea(['id' => 'ckeditor'])->label('内容') ?>
        <?= $form->field($model, 'sort')->textInput(['type' => 'number'])->label('排序') ?>
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
