
<?php
use yii\helpers\Html;
use app\assets\ShowAsset;

ShowAsset::register($this);
$language = \Yii::$app->language;
?>

<h2><?= $langs['title']->{$language} ?></h2>
<?php
echo Html::beginTag('div', ['class' => 'row']);
echo Html::a(Html::button(\Yii::t('app', 'Basket'), ['class' => 'button-panel-own']), '#');
echo Html::a(Html::button(\Yii::t('app', 'Goods'), ['class' => 'button-panel-own']), '/goods/index');
if (!Yii::$app->user->isGuest) {
    echo Html::a(Html::button(\Yii::t('app', 'Edit good'), ['class' => 'button-panel-own']), ['/goods/edit', 'id' => $model->id]);
    echo Html::a(Html::button(\Yii::t('app', 'Edit good`s images'), ['class' => 'button-panel-own']), ['/goods/edit-image', 'id' => $model->id]);
    echo Html::a(Html::button(\Yii::t('app', 'Delete good'), ['class' => 'button-panel-own']), ['/goods/delete', 'id' => $model->id]);
}
echo Html::endTag('div');
?>

<div class="row">
    <div class="col-sm-3 thumb">
<?php
foreach ($srcs as $src) {
    $src = str_replace('\\', '/', $src);
    ?>
    <a data-fancybox="gallery" href="<?= $src ?>">
        <img class="img-responsive" src="<?= $src ?>" alt="">
    </a>
<?php
        }
?>

    </div>
    <div class="col-sm-9 thumb">
        <div class="card-text">
            <div class="caption">
                <?= \Yii::t('app', 'Description') ?>
            </div>
            <?= $langs['description']->{$language} ?>
        </div>
        <div class="card-text">
            <div class="caption">
                <?= \Yii::t('app', 'Service recommendation') ?>
            </div>
            <?= $langs['service_recomendation']->{$language} ?>
        </div>
        <div class="card-text">
            <div class="caption">
                <?= \Yii::t('app', 'Price') ?>
            </div>
            <?= $model->price . ' RUB' ?>
        </div>
        <div class="card-text">
            <div class="caption">
                <?= \Yii::t('app', 'Category') ?>
            </div>
            <?= Html::a($model->getCategoryName(), ['/goods/index', 'category' => $model->category]) ?>
        </div>
        <div class="card-text">
            <div class="caption">
                <?= \Yii::t('app', 'Rubric') ?>
            </div>
            <?= Html::a($model->getRubricName(), ['/goods/index', 'rubric' => $model->rubric]) ?>
        </div>
        <div class="card-text">
            <div class="caption">
                <?= \Yii::t('app', 'Chapter') ?>
            </div>
            <?= Html::a($model->getChapterName(), ['/goods/index', 'chapter' => $model->chapter]) ?>
        </div>
        <div class="card-text">
            <div class="caption">
                <?= \Yii::t('app', 'Size') ?>
            </div>
            <?= $model->size ?>
        </div>
        <div class="card-text">
            <div class="caption">
                <?= \Yii::t('app', 'Work duration') ?>
            </div>
            <?= $model->work_duration . \Yii::t('app', ' days') ?>
        </div>
    </div>
</div>


