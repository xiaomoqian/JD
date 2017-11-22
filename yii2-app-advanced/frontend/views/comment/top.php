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