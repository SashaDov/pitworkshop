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
<!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            // Initialize Tooltip
            $('[data-toggle="tooltip"]').tooltip();

            // Add smooth scrolling to all links in navbar + footer link
            $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

                // Make sure this.hash has a value before overriding default behavior
                if (this.hash !== "") {

                    // Prevent default anchor click behavior
                    event.preventDefault();

                    // Store hash
                    var hash = this.hash;

                    // Using jQuery's animate() method to add smooth page scroll
                    // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 900, function(){

                        // Add hash (#) to URL when done scrolling (default click behavior)
                        window.location.hash = hash;
                    });
                } // End if
            });
        });
    </script>
-->
    <?php $this->head() ?>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
<?php $this->beginBody()
?>
<div class="wrap">
<?php
NavBar::begin([
    'brandLabel' => 'Peter`s studio',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-default navbar-fixed-top',
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
        ['label' => 'Biography', 'url' => ['/site/index']],
        ['label' => 'Materials', 'url' => ['/opportunities/index']],
        [
            'label' => 'Goods',
            'items' => [
                ['label' => 'Винтажное вязаное', 'url' => '#'],
                '<li class="divider"></li>',
                ['label' => 'Книги', 'url' => '#'],
                ['label' => 'Софтбуки', 'url' => '#'],
                ['label' => 'Обложки на книги', 'url' => '#'],
                '<li class="divider"></li>',
                ['label' => 'Сумки и акссесуары', 'url' => '#'],
                ['label' => 'Канцелярия', 'url' => '#'],
                ['label' => 'Шкатулки', 'url' => '#'],
                '<li class="divider"></li>',
                //['label' => 'Level 1 - Dropdown B', 'url' => '#'],
                //'<li class="dropdown-header">Dropdown Header</li>',
                ['label' => 'Вне категории', 'url' => '#'],
            ],
        ],
        Yii::$app->user->isGuest ? (
        ['label' => 'Login', 'url' => ['/auth/login']]
        ) : (
            '<li>'
            . Html::beginForm(['/auth/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>'
        )
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
    <div class="row">
        <div class="col-xs-3">
            <ul>
                <!--<li>Печатка картинка</li>-->
                <li><span class="glyphicon glyphicon-map-marker"></span> Moskow, RU</li>
                <li><span class="glyphicon glyphicon-phone"></span> Phone: +7 926 644 83 66 </li>
                <li><span class="glyphicon glyphicon-envelope"></span> Email: info@pitstudio.com</li>
                <li>Ярмарка мастеров</li>
                <li>

                  <?php
                    echo Html::img("/img/vk.png");
                    ?>
                    vk, instagram buttons
                </li>
            </ul>
        </div>
        <div class="col-xs-3">
            <?php
            $items = [
                'Contacts' => '/info/index.php',
                'Biography' => '/info/biography.php',
                'Studio`s map' => '/info/map.php',
                'Delivery' => '/info/delivery.php',
                'Order' => '/info/order.php',
                'Promo' => '/info/promo.php',
            ];
            echo Html::ul($items, ['item' => function ($item, $index) {
                $link = Html::a($index, $item);
                return "<li>{$link}</li>";
            }]);
            ?>
        </div>
        <div class="col-xs-3">
            <?php
            echo Html::ul([
                'Вязаное',
                'Книги',
                'Софтбуки',
                'Сумки',
                'Пеналы'
            ]);
            ?>
        </div>
        <div class="col-xs-3">
            <?php
            echo Html::ul([
                'Изотерика',
                'Научно-публицистическое',
                'Сувениры и подарки',
                'For Fans',
                'For SALE'
            ]);
            ?>
        </div>
    </div>
    <p>&copy; <a href="https://www.pitworkshop.com" data-toggle="tooltip" title="Visit Peter`s studio">Peter`s studio </a>
    <?php echo date('Y'); ?></p>
    </div>
</footer>




<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
