<?php
use yii\bootstrap\Carousel;
use app\assets\IndexAsset;
use app\assets\AppAsset;

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
        '<img src="/img/q1.jpg"/>',
        ['content' => '<img src="/img/q2.jpg"/>'],
        [
            'content' => '<img src="/img/q3.jpg"/>',
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
<div class="row" style="background-color: white; padding-top: 15px">

    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <div class="text-center">
            <em><h3>* * *</h3>
            <h4 style="color: #aa8f55;">Рад приветствовать вас в моей мастерской,
                в стенах которой я работаю над созданием
                волшебной атмосферы. Книги, шкатулки, наборы для письма, чехлы и сумки,
                настольные игры, носочки, жилетки, головные уборы, гребни, руны, мешочки, софтбуки -
                все они создаются с желанием максимально передать неповторимую атмосферу мира, который полюбился именно вам.
                Я не повторяю свои работы, полагая, что неповторимость придаёт особый шарм каждому творению.
                Для меня все они одушевлённые помощники для своих владельцев.
                И у каждого создания свой собственный характер, ведь на протяжении своего рождения, они сами
                сообщают мне, какими хотят себя видеть.
                Свои создания я творю из натуральных материалов: кожа, кость, металл, шерсть, состаренная бумага.
                С заказами работаю в различных стилях.
                Все изделия изготавливаются вручную.</h4>
            <h3>* * *</h3></em>
        </div>
    </div>
    <div class="col-sm-4"></div>
</div>




