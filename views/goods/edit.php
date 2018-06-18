<?php

use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\models\Goods;
use yii\helpers\Html;
?>

<?php
$language = \Yii::$app->language;
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>
<?= $form->field($goods_model,'records[title]')->textInput()->label('Title') ?>
<?= $form->field($goods_model,'alias')->textInput() ?>
<?= $form->field($goods_model, 'category')->dropdownList(Goods::categories(),
    ['prompt'=>'Select Category']
); ?>
<?= $form->field($goods_model, 'rubric')->dropdownList(Goods::rubrics(),
    ['prompt'=>'Select Rubric']
); ?>
<?= $form->field($goods_model, 'chapter')->dropdownList(Goods::chapters(),
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
<div>
    <button class="button-panel-own" type="submit">Update</button>
    <?php
    echo Html::a(Html::button('Cancel',
        ['class' => 'button-panel-own']), ['/goods/show', 'id' => $goods_model->id]);
    ?>
</div>
<?php $form = ActiveForm::end();?>
