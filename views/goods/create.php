<?php

use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
?>

<?php

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>
<?= $form->field($goods_model,'title')->textInput() ?>
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
<?= $form->field($goods_model,'description')->textarea() ?>
<?= $form->field($goods_model,'service_recomendation')->textarea() ?>
<?= $form->field($goods_model,'price')->textInput() ?>
<?= $form->field($goods_model,'size')->textInput() ?>
<?= $form->field($goods_model,'work_duration')->textInput() ?>
<?= $form->field($goods_model,'date_start')->widget(DatePicker::className(), [
    //'language' => 'ru',
    'dateFormat' => 'yyyy-MM-dd',
])
//?>
<?//= $form->field($goods_model, 'imageFile')->fileInput() ?>
<div>
    <button class="btn btn-success" type="submit">Create</button>
</div>
<?php $form = ActiveForm::end();?>
