<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\models\File;
?>

<h2><?= \Yii::t('app', 'Goods') ?> </h2>

<?php
$language = \Yii::$app->language;

if (!Yii::$app->user->isGuest) {
    echo Html::beginTag('div', ['class' => 'row']);
    echo Html::a(Html::button(\Yii::t('app', 'Create good'), ['class' => 'button-panel-own']), '/goods/create');
    echo Html::endTag('div');
}

echo Html::beginTag('div', ['class' => 'row']);
foreach ($links as $link) {

    //$file = new File();
    $src = $link->file->getFileRealPath();
    $src = str_replace('\\', '/', $src); //  /img/top/q1.jpg

    $title = $link->lang->{$language};
    $description = $link->getLang('description')->one()->{$language};
    $description = mb_strimwidth($description, 0, 100, '...')
    ?>

    <div class="col-sm-4">
        <div class="thumbnail">
            <div class="imageWrap">
                <?php
                echo Html::beginTag('div', ['style' => 'background: url('. $src .') no-repeat']);
                echo $title;
                echo Html::endTag('div');
                ?>
            </div>
            <div class="caption">
                <?php
                echo $description;
                    ?>
            </div>
            <div class="btn-group">
                <?php
                echo Html::a(Html::button(\Yii::t('app', 'View'), ['class' => 'btn btn-sm btn-outline-secondary btn-card']), ['/goods/show', 'id' => $link->id]);
                echo Html::a(Html::button(\Yii::t('app', 'Basket'), ['class' => 'btn btn-sm btn-outline-secondary btn-card']), ['/goods/show', 'id' => $link->id]);
                ?>
            </div>
            <small class="text-muted"><?= $link->price . ' RUB' ?></small>
        </div>
    </div>


<?php
}
echo Html::endTag('div');
//прикрутить js, где будет открываться инфа по сделкам, сами сделки - ссылки
?>

<div class="row">
    <div class="col-sm-4">
<?= LinkPager::widget(['pagination' => $pagination]) ?>
    </div>
</div>
