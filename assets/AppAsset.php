<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;



//<link rel="stylesheet" type="text/css" href="assets/css/main.css">
//    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
//    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
//    <link rel="stylesheet" type="text/css" href="assets/vendor/owl-carousel/owl.carousel.css">
//    <link rel="stylesheet" type="text/css" href="assets/vendor/owl-carousel/owl.theme.css">
//    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap-daterangepicker/daterangepicker-bs3.css">
//
//    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap-tour/css/bootstrap-tour.min.css">
//
//
//    <link href="https://fonts.googleapis.com/css?family=Cinzel|Roboto" rel="stylesheet">

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

        'vendor/bootstrap-daterangepicker/daterangepicker.css',
        'css/font-awesome.min.css',
        'js/owl/owl.carousel.min.css',
        'css/font.googleapi.css',
        'css/jquery.rateyo.min.css',
        'css/main.css',
        'css/custom.css',
        'css/styleLess.css',
        'css/rangeslider.css',
        'css/croppic.css',
        'css/cropit.styling.css'
    ];
    public $js = [
     'vendor/moment/moment.min.js',
        
        'vendor/bootstrap-daterangepicker/daterangepicker.js',
    'js/owl/owl.carousel.min.js',
    'js/custom.js',
    'js/ease.min.js',
    'js/rateyo.min.js',  
    'js/jquery.cropit.js',
    'js/rangeslider.min.js',    
   'js/jquery.raty.min.js',
        'js/croppic.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\widgets\ActiveFormAsset',
        'yii\validators\ValidationAsset',
    ];
}
