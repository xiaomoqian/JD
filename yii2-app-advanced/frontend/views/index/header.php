
<!-- 顶部导航 start -->
<div class="topnav">
    <div class="topnav_bd w990 bc">
        <div class="topnav_left">
        </div>
        <div class="topnav_right fr">
            <ul>
                <li>
                    <?php echo isset(Yii::$app->user->identity->username)?"您好[".Yii::$app->user->identity->username."]，欢迎来到京西":' '?>
                    <?php echo isset(Yii::$app->user->identity->username)?\yii\helpers\Html::a("[退出]",['user/out']):\yii\helpers\Html::a("[登录]",['user/login'])?>
                    [<?=\yii\helpers\Html::a("免费注册",['user/index'])?>]
                </li>
                <li class="line">|</li>
                <li>我的订单</li>
                <li class="line">|</li>
                <li>客户服务</li>

            </ul>
        </div>
    </div>
</div>
<!-- 顶部导航 end -->
<div style="clear:both;"></div>
<!-- 头部 start -->
<div class="header w1210 bc mt15">
    <!-- 头部上半部分 start 包括 logo、搜索、用户中心和购物车结算 -->
    <div class="logo w1210">
        <h1 class="fl">
            <?=\yii\helpers\Html::a(\yii\helpers\Html::img("@web/images/logo.png",['alt'=>'今夕商城']),['index/index'])?>
        </h1>
        <!-- 头部搜索 start -->
        <div class="search fl">
            <div class="search_form">
                <div class="form_left fl"></div>
                <form action="" name="serarch" method="get" class="fl" >
                    <input type="text" class="txt" value="请输入商品关键字" /><input type="submit" class="btn" value="搜索" />
                </form>
                <div class="form_right fl"></div>
            </div>

            <div style="clear:both;"></div>

            <div class="hot_search">
                <strong>热门搜索:</strong>
                <a href="/">D-Link无线路由</a>
                <a href="/">休闲男鞋</a>
                <a href="/">TCL空调</a>
                <a href="/">耐克篮球鞋</a>
            </div>
        </div>
        <!-- 头部搜索 end -->

        <!-- 用户中心 start-->
        <div class="user fl">
            <dl>
                <dt>
                    <em></em>
                    <a href="/">用户中心</a>
                    <b></b>
                </dt>
                <dd>
                    <div class="prompt">
                        <?php echo isset(Yii::$app->user->identity->username)?"欢迎您：".Yii::$app->user->identity->username:'您好，请'.\yii\helpers\Html::a("登录",['user/login'])?>
                    </div>
                    <div class="uclist mt10">
                        <ul class="list1 fl">
                            <li><a href="/">用户信息></a></li>
                            <li><a href="/">我的订单></a></li>
                            <li><?=\yii\helpers\Html::a("收货地址>",['ress/index'])?></li>
                            <li><a href="/">我的收藏></a></li>
                        </ul>

                        <ul class="fl">
                            <li><a href="/">我的留言></a></li>
                            <li><a href="/">我的红包></a></li>
                            <li><a href="/">我的评论></a></li>
                            <li><a href="/">资金管理></a></li>
                        </ul>

                    </div>
                    <div style="clear:both;"></div>
                    <div class="viewlist mt10">
                        <h3>最近浏览的商品：</h3>
                        <ul>
                            <li><a href="/"><?=\yii\helpers\Html::img("@web/images/view_list1.jpg")?></a></li>
                            <li><a href="/"><?=\yii\helpers\Html::img("@web/images/view_list2.jpg")?></a></li>
                            <li><a href="/"><?=\yii\helpers\Html::img("@web/images/view_list3.jpg")?></a></li>

                        </ul>
                    </div>
                </dd>
            </dl>
        </div>
        <!-- 用户中心 end-->

        <!-- 购物车 start -->
        <div class="cart fl">
            <dl>
                <dt>
                    <?=\yii\helpers\Html::a("去购物车结算",['index/cart'])?>
                    <b></b>
                </dt>
                <dd>
                    <div class="prompt">
                        购物车中还没有商品，赶紧选购吧！
                    </div>
                </dd>
            </dl>
        </div>
        <!-- 购物车 end -->
    </div>
    <!-- 头部上半部分 end -->
