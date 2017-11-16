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
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];

}