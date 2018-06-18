<?php
use app\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <?php $this->head() ?>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
<?php $this->beginBody()
?>
<div class="wrap">
<?php
NavBar::begin([
    'brandLabel' => 'Pit`s Studio',//Html::img('/img/icons/ps_white.png', ['class' => 'head-stamp']),
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-default navbar-fixed-top',
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
            [
                'label' => 'About',
                'items' => [
                    ['label' => 'Contacts', 'url' => ['/about/contact']],
                    ['label' => 'Biography', 'url' => ['#']],
                    ['label' => 'Materials', 'url' => ['#']],
                ],
            ],
        [
            'label' => 'Goods',
            'items' => [
                ['label' => Yii::t('app', 'All categories'), 'url' => '/goods/index'],
                '<li class="divider"></li>',
                ['label' => Yii::t('app', 'Knitted'), 'url' => ['/goods/index', 'category' => '1']],
                '<li class="divider"></li>',
                ['label' => \Yii::t('app', 'Books'), 'url' => ['/goods/index', 'category' => '2']],
                ['label' => \Yii::t('app', 'Softbooks'), 'url' => ['/goods/index', 'category' => '3']],
                ['label' => \Yii::t('app', 'Stationery'), 'url' => ['/goods/index', 'category' => '4']],
                '<li class="divider"></li>',
                ['label' => \Yii::t('app', 'Handbags'), 'url' => ['/goods/index', 'category' => '5']],
                ['label' => \Yii::t('app', 'Caskets and boxes'), 'url' => ['/goods/index', 'category' => '6']],
                ['label' => \Yii::t('app', 'Accessories'), 'url' => ['/goods/index', 'category' => '7']],
//                '<li class="divider"></li>',
                //['label' => 'Level 1 - Dropdown B', 'url' => '#'],
                //'<li class="dropdown-header">Dropdown Header</li>',
            ],
        ],
        [
            'label' => strtoupper(Yii::$app->language),
            'items' => \app\widgets\LanguageDropdown::widget(),
        ],
    ],
]);
NavBar::end();
?>

    <div class="container">

        <?= $content ?>
    </div>
</div>
<!-- Footer -->

<footer class="text-center">
    <div class="container">
    <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
        <span class="glyphicon glyphicon-chevron-up"></span>
    </a><br><br>
    <div class="row" style="text-align: start;">
        <div class="col-sm-4">
            <ul>
                <li>
                    <?php
                    echo Html::img('/img/icons/ps_white.png', ['class' => 'head-stamp']);
                    ?>
                </li>
                <li><span class="glyphicon glyphicon-map-marker"></span> Moskow, RU</li>
                <li><span class="glyphicon glyphicon-phone"></span> Phone: +7 926 644 83 66 </li>
                <li><span class="glyphicon glyphicon-envelope"></span> Email: info@pitworkshop.com</li>
                <li>
                    <?php
                    echo Html::a(Html::img("/img/icons/vk.png", ['class' => 'img-icons-links']), 'https://vk.com/pits_studio', ['target' => 'blank']);
                    echo Html::a(Html::img("/img/icons/fc.png", ['class' => 'img-icons-links']), '#', ['target' => 'blank']);
                    echo Html::a(Html::img("/img/icons/lm.png", ['class' => 'img-icons-links']), 'https://www.livemaster.ru/pitsstudio', ['target' => 'blank']);
                    echo Html::a(Html::img("/img/icons/tw.png", ['class' => 'img-icons-links']), 'https://twitter.com/Pit_Cogger', ['target' => 'blank']);
                    echo Html::a(Html::img("/img/icons/ig.png", ['class' => 'img-icons-links']), 'https://www.instagram.com/_w_pit_/', ['target' => 'blank']);
                    ?>
                </li>
                <li>
                <?php
                if (Yii::$app->user->isGuest) {
                    echo ''; //Html::a('Login', '/auth/login');
                } else {
                    echo Html::beginForm(['/auth/logout'], 'post');
                    echo Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']);
                    echo Html::endForm();
                }
                ?>
                </li>
            </ul>
        </div>
        <div class="col-sm-4">
            <?php
            $items = [
                'Contacts' => '#',//'/info/index.php',
                'Biography' => '#',//'/info/biography.php',
                'Studio`s map' => '#',//'/info/map.php',
                'Delivery' => '#',//'/info/delivery.php',
                'Order' => '#',//'/info/order.php',
                'Promo' => '#',//'/info/promo.php',
                'For Fans' => '#',//'/goods/for-fans.php',
                'For SALE' => '#',//'/goods/for-sale.php',
            ];
            echo Html::ul($items, ['item' => function ($item, $index) {
                $link = Html::a(Yii::t('app', $index), $item);
                return "<li>{$link}</li>";
            }]);
            ?>
        </div>
        <div class="col-sm-4">
            <?php
            $items = [
                'In stock' => ['/goods/index', 'chapter' => '1'],
                'For example' => ['/goods/index', 'chapter' => '2'],
                'Esoteric' => ['/goods/index', 'rubric' => '1'],
                'Serials' => ['/goods/index', 'rubric' => '2'],
                'Movies' => ['/goods/index', 'rubric' => '3'],
                'Harry Potter' => ['/goods/index', 'rubric' => '4'],
                'Souvenirs and gifts' => ['/goods/index', 'rubric' => '5'],
            ];
            echo Html::ul($items, ['item' => function ($item, $index) {
                $link = Html::a(Yii::t('app', $index), $item);
                return "<li>{$link}</li>";
            }]);
            ?>
        </div>
<!--        <div class="col-md-3">-->
<!--            --><?php
//            echo Html::ul([
//
//            ]);
//            ?>
<!--        </div>-->
    </div>
        <br>
    <p>&copy; <a href="https://www.pitworkshop.com" data-toggle="tooltip" title="Visit Pit`s studio">Pit`s studio </a>
    <?php echo date('Y'); ?></p>
    </div>
</footer>




<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
