<?php
namespace app\assets;

use yii\web\AssetBundle;

class ShowAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/jquery.fancybox.min.css',
        'css/fancyadd.css',
    ];
    public $js = [
        'js/jquery.fancybox.min.js',
        'js/jquery.easing.1.3.min.js',
        'js/jquery.mousewheel.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\AppAsset'
    ];
}