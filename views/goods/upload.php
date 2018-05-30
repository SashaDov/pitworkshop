<?php
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
//use kartik\date\DatePicker;

?>

<?php

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>

<?= $form->field($goods_model, 'imageFile')->fileInput() ?>
    <div>
        <button class="btn btn-success" type="submit">upload</button>
    </div>
<?php $form = ActiveForm::end();?>