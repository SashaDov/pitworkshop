
<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h2>Goods</h2>

<?php foreach ($links as $link) {
    //echo Html::img('/img/icons/img_fonts.png')
    //echo Html::tag('div', '', ['class' => 'goods-one-block-for-good'])
    ?>
    <div class="row"></div>
    <div class= 'goods-one-block-for-good'>
        <img src="/img/top/q3.jpg" width="100%" height="100%">
        <h3><?= $link->title ?></h3>
        <h4><?= $link->category ?></h4>
        <h4><?= $link->price ?></h4>
    </div>


<?php
}
//прикрутить js, где будет открываться инфа по сделкам, сами сделки - ссылки
?>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
<a href="/goods/create"><button type="button" class="btn btn-primary">Create good</button></a>
