<?php
use yii\helpers\Html;
use app\assets\ShowAsset;
use yii\widgets\ActiveForm;

ShowAsset::register($this);
$language = \Yii::$app->language;

$title = $model->lang->{$language};
echo $title;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>
<?= $form->field($model, 'documents[]')->fileInput(['multiple' => true])->label(false) ?>
<div>
    <button class="button-panel-own" type="submit">Add files</button>
    <?php
    echo Html::a(Html::button('Cancel',
        ['class' => 'button-panel-own']), ['/goods/show', 'id' => $model->id]);
    ?>
</div>
<?php $form = ActiveForm::end();?>


<div class="row">
<?php
foreach ($srcs as $id => $src) {
    $src = str_replace('\\', '/', $src);
    ?>
    <div class="col-sm-3 thumb">
    <a data-fancybox="gallery" href="<?= $src ?>">
        <img class="img-responsive" style="height: 200px" src="<?= $src ?>" alt="">
        <?php
        echo Html::a(Html::button('Delete file',
            ['class' => 'btn btn-sm btn-outline-secondary btn-card',
                'style' => 'border: 1px solid white;']),
            ['/file/delete-file', 'id' => $id]);
        ?>
    </a>
    </div>
    <?php
}
?>
</div>