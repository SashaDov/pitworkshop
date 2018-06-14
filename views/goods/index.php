<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\models\File;
?>

<h2>Goods</h2>

<?php
$language = \Yii::$app->language;

if (!Yii::$app->user->isGuest) {
    echo Html::beginTag('div', ['class' => 'row']);
    echo Html::a(Html::button('Create good', ['class' => 'button-panel-own']), '/goods/create');
    echo Html::a(Html::button('Edit good', ['class' => 'button-panel-own']), '/goods/create');
    echo Html::a(Html::button('Delete good', ['class' => 'button-panel-own']), '/goods/create');
    echo Html::a(Html::button('Preview good', ['class' => 'button-panel-own']), '/goods/create');
    echo Html::endTag('div');
}

foreach ($links as $link) {

    $file = new File();
    $src = $file->getFileRealPath($link->file->entity_type, $link->file->document);
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
                echo Html::a(Html::button('View', ['class' => 'btn btn-sm btn-outline-secondary btn-card']), ['/goods/show', 'id' => $link->id]);
                echo Html::a(Html::button('Basket', ['class' => 'btn btn-sm btn-outline-secondary btn-card']), ['/goods/show', 'id' => $link->id]);
                ?>
            </div>
            <small class="text-muted"><?= $link->price ?></small>
        </div>
    </div>


<?php
}
//прикрутить js, где будет открываться инфа по сделкам, сами сделки - ссылки
?>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
