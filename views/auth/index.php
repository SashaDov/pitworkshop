<?php
use yii\bootstrap\Carousel;
use app\assets\IndexAsset;
use app\assets\AppAsset;
use yii\helpers\Html;

$this->title = "Pit`s studio";
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Мастер Пит творит винтаж, сказку, магию...'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Винтаж, сказка, магия, книги...'
]);
IndexAsset::register($this);

echo Carousel::widget([
    'items' => [
        '<img src="/img/top/q1.jpg"/>',
        '<img src="/img/top/q2.jpg"/>',
        '<img src="/img/top/q4.jpg"/>',
        '<img src="/img/top/q5.jpg"/>',
        '<img src="/img/top/q6.jpg"/>',
        //Html::img('/img/top/q1.jpg'),
        ['content' => '<img src="/img/top/q7.jpg"/>'],
        [
            'content' => '<img src="/img/top/q3.jpg"/>',
            'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
            'options' => [],
        ],
    ],
    'options' => ['class' => 'carousel slide', 'data-interval' => '12000'],
    'controls' => [
        '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>',
        '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'
    ]
]);
?>
<div class="row" id="index-row">


            <em><br>
                <div id="quote">
            <h4>&quot; Рад приветствовать Вас в моей волшебной мастерской, откуда выходят в мир книги, шкатулки, наборы для письма, чехлы и сумки, настольные игры, носочки, жилетки, головные уборы, гребни, руны, мешочки, софтбуки и прочее, что может привнести сказку в Вашу жизнь. В каждую работу вкладывается частичка души, отчего творение неповторимо и имеет свой собственный характер. И да, я создаю несовременность!..&quot;
               <br></h4>
                <h4 style="text-align: right;">&copy Pit Cogger</h4>
                </div>
            </em>


</div>




