
<?php
use yii\helpers\Html;

$language = \Yii::$app->language;
foreach ($srcs as $src) {
    echo Html::img($src);
}
foreach ($langs as $lang) {
    echo $lang->{$language};
}
echo $model->price;
echo $model->size;
echo $model->work_duration;
echo $model->category;
echo $model->chapter;
$p = \Yii::getAlias('@app') . "/uploads/goods/14b39504d15774d01e3d655e07d67a1463e0d82f653c3637fd03079a7df3047c39c5f961a73a5049.jpg";
?>
<img src="<?= $p ?>">
