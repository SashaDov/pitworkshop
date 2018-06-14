
<?php
use yii\helpers\Html;
use app\assets\ShowAsset;

ShowAsset::register($this);

$language = \Yii::$app->language;
//foreach ($srcs as $src) {
//    echo Html::img($src);
//}
foreach ($langs as $lang) {
    echo $lang->{$language};
}
echo $model->price;
echo $model->size;
echo $model->work_duration;
echo $model->category;
echo $model->chapter;

?>



<h1>Good</h1>



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

<!--        <a data-fancybox="gallery" href="/img/top/q4.jpg">-->
<!--            <img class="img-responsive" src="/img/top/q4.jpg" alt="">-->
<!--        </a>-->
<!---->
<!--        <a data-fancybox="gallery" href="/img/top/q3.jpg">-->
<!--            <img class="img-responsive" src="/img/top/q3.jpg" alt="">-->
<!--        </a>-->
<!---->
<!--        <a data-fancybox="gallery" href="/img/top/q2.jpg">-->
<!--            <img class="img-responsive" src="/img/top/q2.jpg" alt="">-->
<!--        </a>-->
<!---->
<!--        <a data-fancybox="gallery" href="/img/top/q1.jpg">-->
<!--            <img class="img-responsive" src="/img/top/q1.jpg" alt="">-->
        </a>
    </div>

</div>


