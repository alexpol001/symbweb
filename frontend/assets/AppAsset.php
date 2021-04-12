<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/modal-order.css',
        'css/media.css',
        'css/animate.css',
//        'css/preloader.css',
        'plugins/animation/animate.css',
    ];
    public $js = [
        'plugins/countTo/jquery.countTo.js',
//        'js/preloader.js',
        'plugins/animation/wow.js',
        'js/common.js',
        'js/main-menu.js',
        'js/slider.js',
        'js/advantage.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
    ];
}
