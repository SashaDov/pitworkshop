<?php

use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
//use kartik\date\DatePicker;

?>

<?php
$language = \Yii::$app->language;
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>
<?= $form->field($goods_model,'records[title]')->textInput()->label('Title') ?>
<?= $form->field($goods_model,'alias')->textInput() ?>
<?= $form->field($goods_model, 'category')->dropdownList([
    1 => 'item 1',
    2 => 'item 2'
],
    ['prompt'=>'Select Category']
); ?>
<?= $form->field($goods_model, 'chapter')->dropdownList([
    1 => 'item 3',
    2 => 'item 4'
],
    ['prompt'=>'Select Chapter']
); ?>
<?= $form->field($goods_model,'records[description]')->textarea()->label('Description') ?>
<?= $form->field($goods_model,'records[service_recomendation]')->textarea()->label('Service recommendation') ?>
<?= $form->field($goods_model,'price')->textInput() ?>
<?= $form->field($goods_model,'size')->textInput() ?>
<?= $form->field($goods_model,'work_duration')->textInput() ?>
<?= $form->field($goods_model,'date_start')->widget(DatePicker::class, [
    'language' => $language,
    'dateFormat' => 'yyyy-MM-dd',
])
?>
<?= $form->field($goods_model, 'documents[]', ['enableClientValidation' => true])->fileInput(['multiple' => true]) ?>
<div>
    <button class="btn btn-success" type="submit">Create</button>
</div>
<?php $form = ActiveForm::end();?>
