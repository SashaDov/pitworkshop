
<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\models\File;
?>
<h2>Goods</h2>

<?php foreach ($links as $link) {

    $file = new File();
    $src = $file->getFileRealPath('goods', $link->file->document);
    ?>

    <div class="col-md-4">
        <div class="thumbnail">
            <a href="#">
                <img src="<?= $src ?>" alt="Lights" style="width:100%">
                <div class="caption">
                    <p>Lorem ipsum...</p>
                </div>
            </a>
            <h3><?= $link->title ?></h3>
            <h4><?= $link->category ?></h4>
            <h4><?= $link->price ?></h4>
        </div>
    </div>


<?php
}
//прикрутить js, где будет открываться инфа по сделкам, сами сделки - ссылки
?>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
<a href="/goods/create"><button type="button" class="btn btn-primary">Create good</button></a>
