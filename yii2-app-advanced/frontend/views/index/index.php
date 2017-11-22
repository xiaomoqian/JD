<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>京西商城</title>
    <link rel="stylesheet" href="/style/base.css" type="text/css">
    <link rel="stylesheet" href="/style/global.css" type="text/css">
    <link rel="stylesheet" href="/style/header.css" type="text/css">
    <link rel="stylesheet" href="/style/index.css" type="text/css">
    <link rel="stylesheet" href="/style/bottomnav.css" type="text/css">
    <link rel="stylesheet" href="/style/footer.css" type="text/css">

    <script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/js/header.js"></script>
    <script type="text/javascript" src="/js/index.js"></script>
</head>
<body>
<?php require_once "header.php"?>
    <div style="clear:both;"></div>

    <!-- 导航条部分 start -->
    <div class="nav w1210 bc mt10">
        <!--  商品分类部分 start-->
       <?=\frontend\widgets\GoodsCateWidget::widget(['isIndex'=>Yii::$app->controller->route])?>
        <!--  商品分类部分 end-->

        <div class="navitems fl">
            <ul class="fl">
                <li class="current"><a href="/">首页</a></li>
                <li><a href="/">电脑频道</a></li>
                <li><a href="/">家用电器</a></li>
                <li><a href="/">品牌大全</a></li>
                <li><a href="/">团购</a></li>
                <li><a href="/">积分商城</a></li>
                <li><a href="/">夺宝奇兵</a></li>
            </ul>
            <div class="right_corner fl"></div>
        </div>
    </div>
    <!-- 导航条部分 end -->
</div>
<!-- 头部 end-->

<div style="clear:both;"></div>

<!-- 综合区域 start 包括幻灯展示，商城快报 -->
<div class="colligate w1210 bc mt10">
    <!-- 幻灯区域 start -->
    <div class="slide fl">
        <div class="area">
            <div class="slide_items">
                <ul>
                    <li><a href="/"><?=\yii\helpers\Html::img("@web/images/index_slide1.jpg")?></a></li>
                    <li><a href="/"><?=\yii\helpers\Html::img("@web/images/index_slide2.jpg")?></a></li>
                    <li><a href="/"><?=\yii\helpers\Html::img("@web/images/index_slide3.jpg")?></a></li>
                    <li><a href="/"><?=\yii\helpers\Html::img("@web/images/index_slide4.jpg")?></a></li>
                    <li><a href="/"><?=\yii\helpers\Html::img("@web/images/index_slide5.jpg")?></a></li>
                    <li><a href="/"><?=\yii\helpers\Html::img("@web/images/index_slide6.jpg")?></a></li>

                </ul>
            </div>
            <div class="slide_controls">
                <ul>
                    <li class="on">1</li>
                    <li>2</li>
                    <li>3</li>
                    <li>4</li>
                    <li>5</li>
                    <li>6</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- 幻灯区域 end-->

    <!-- 快报区域 start-->
    <div class="coll_right fl ml10">
        <div class="ad"><a href="/"><?=\yii\helpers\Html::img("@web/images/ad.jpg")?></a></div>
    <?=\frontend\widgets\NewsWidget::widget()?>

    <!-- 快报区域 end-->
</div>
<!-- -综合区域 end -->
</div>
<div style="clear:both;"></div>

<!-- 导购区域 start -->
<div class="guide w1210 bc mt15" >
    <!-- 导购左边区域 start -->
    <div class="guide_content fl" style="float: left">
        <h2>
            <span class="on">新品上架</span>
            <span>热卖商品</span>
            <span>精品推荐</span>
        </h2>

        <div class="guide_wrap">
            <!-- 疯狂抢购 start-->
            <div class="crazy">
                <ul>
                    <li>
                        <dl>
                            <dt><a href="/"><?=\yii\helpers\Html::img("@web/images/crazy1.jpg")?></a></dt>
                            <dd><a href="/">惠普G4-1332TX 14英寸</a></dd>
                            <dd><span>售价：</span><strong> ￥2999.00</strong></dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt><a href="/"><?=\yii\helpers\Html::img("@web/images/crazy2.jpg")?></a></dt>
                            <dd><a href="/">直降100元！TCL118升冰箱</a></dd>
                            <dd><span>售价：</span><strong> ￥800.00</strong></dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt><a href="/"><?=\yii\helpers\Html::img("@web/images/crazy3.jpg")?></a></dt>
                            <dd><a href="/">康佳液晶37寸电视机</a></dd>
                            <dd><span>售价：</span><strong> ￥2799.00</strong></dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt><a href="/"><?=\yii\helpers\Html::img("@web/images/crazy4.jpg")?></a></dt>
                            <dd><a href="/">梨子平板电脑7.9寸</a></dd>
                            <dd><span>售价：</span><strong> ￥1999.00</strong></dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt><a href="/">
                                    <?=\yii\helpers\Html::img("@web/images/crazy5.jpg")?>
                                </a></dt>
                            <dd><a href="/">好声音耳机</a></dd>
                            <dd><span>售价：</span><strong> ￥199.00</strong></dd>
                        </dl>
                    </li>
                </ul>
            </div>
            <!-- 疯狂抢购 end-->

            <!-- 热卖商品 start -->
            <div class="hot none">
                <ul>
                    <li>
                        <dl>
                            <dt><a href="/"><?=\yii\helpers\Html::img("@web/images/hot1.jpg")?></a></dt>
                            <dd><a href="/">索尼双核五英寸四核手机！</a></dd>
                            <dd><span>售价：</span><strong> ￥1386.00</strong></dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt><a href="/"><?=\yii\helpers\Html::img("@web/images/hot2.jpg")?></a></dt>
                            <dd><a href="/">华为通话平板仅需969元！</a></dd>
                            <dd><span>售价：</span><strong> ￥969.00</strong></dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt><a href="/">
                                    <?=\yii\helpers\Html::img("@web/images/hot3.jpg")?>
                                </a></dt>
                            <dd><a href="/">卡姿兰明星单品7件彩妆套装</a></dd>
                            <dd><span>售价：</span><strong> ￥169.00</strong></dd>
                        </dl>
                    </li>
                </ul>
            </div>
            <!-- 热卖商品 end -->

            <!-- 推荐商品 atart -->
            <div class="recommend none">
                <ul>
                    <li>
                        <dl>
                            <dt><a href="/"><?=\yii\helpers\Html::img("@web/images/recommend1.jpg")?></a></dt>
                            <dd><a href="/">黄飞红麻辣花生整箱特惠装</a></dd>
                            <dd><span>售价：</span><strong> ￥139.00</strong></dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt><a href="/">
                                    <?=\yii\helpers\Html::img("@web/images/recommend2.jpg")?>
                                </a></dt>
                            <dd><a href="/">戴尔IN1940MW 19英寸LE</a></dd>
                            <dd><span>售价：</span><strong> ￥679.00</strong></dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                            <dt><a href="/">
                                    <?=\yii\helpers\Html::img("@web/images/recommend3.jpg")?>
                                </a></dt>
                            <dd><a href="/">罗辑思维音频车载CD</a></dd>
                            <dd><span>售价：</span><strong> ￥24.80</strong></dd>
                        </dl>
                    </li>
                </ul>
            </div>
            <!-- 推荐商品 end -->

        </div>

    </div>
    <!-- 导购左边区域 end -->

    <!-- 侧栏 网站首发 start-->
    <div class="sidebar fl ml10">
        <h2><strong>网站首发</strong></h2>
        <div class="sidebar_wrap">
            <dl class="first">
                <dt class="fl"><a href="/">
                        <?=\yii\helpers\Html::img("@web/images/viewsonic.jpg")?>
                    </a></dt>
                <dd><strong><a href="/">ViewSonic优派N710 </a></strong> <em>首发</em></dd>
                <dd>苹果iphone 5免费送！攀高作为全球智能语音血压计领导品牌，新推出的黑金刚高端智能电子血压计，改变传统测量方式让血压测量迈入一体化时代。</dd>
            </dl>

            <dl>
                <dt class="fr"><a href="/">
                        <?=\yii\helpers\Html::img("@web/images/samsung.jpg")?>
                    </a></dt>
                <dd><strong><a href="/">Samsung三星Galaxy</a></strong> <em>首发</em></dd>
                <dd>电视百科全书，360°无死角操控，感受智能新体验！双核CPU+双核GPU+MEMC运动防抖，58寸大屏打造全新视听盛宴！</dd>
            </dl>
        </div>


    </div>
    <!-- 侧栏 网站首发 end -->

</div>
<!-- 导购区域 end -->

<div style="clear:both;"></div>

<!--1F 电脑办公 start -->
<?=\frontend\widgets\DianNaoWidget::widget()?>
<!--1F 电脑办公 start -->


<div style="clear:both;"></div>

<!-- 底部导航 start -->
<?=\frontend\widgets\BottomWidget::widget()?>
<!-- 底部导航 end -->

<div style="clear:both;"></div>
<!-- 底部版权 start -->
<?php echo \frontend\widgets\FootWidget::widget()?>
<!-- 底部版权 end-->
</body>
</html>