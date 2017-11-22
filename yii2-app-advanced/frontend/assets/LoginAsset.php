<?php
/**
 * Created by PhpStorm.
 * User: SAMSUNG
 * Date: 2017/11/16
 * Time: 14:23
 */

namespace frontend\assets;


use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "style/base.css" ,
        "style/global.css" ,
        "style/header.css" ,
        "style/login.css" ,
        "style/footer.css" ,

        "style/index.css" ,
        "style/bottomnav.css" ,
        "style/footer.css" ,
    ];
    public $js = [
            "js/jquery-1.8.3.min.js",
            "js/header.js",
            "js/index.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];

}