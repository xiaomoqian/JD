<?php
/**
 * Created by PhpStorm.
 * User: SAMSUNG
 * Date: 2017/11/17
 * Time: 19:19
 */

namespace frontend\widgets;


use yii\base\Widget;

class NewsWidget extends Widget
{
    public function run()
    {
        return <<<EOF

        <div class="news mt10">
            <h2><a href="/">更多快报&nbsp;></a><strong>网站快报</strong></h2>
            <ul>
                <li class="odd"><a href="/">电脑数码双11爆品抢不停</a></li>
                <li><a href="/">买茶叶送武夷山旅游大奖</a></li>
                <li class="odd"><a href="/">爆款手机最高直降1000</a></li>
                <li><a href="/">新鲜褚橙全面包邮开售！</a></li>
                <li class="odd"><a href="/">家具家装全场低至3折</a></li>
                <li><a href="/">买韩束，志玲邀您看电影</a></li>
                <li class="odd"><a href="/">美的先行惠双11快抢悦</a></li>
                <li><a href="/">享生活 疯狂周期购！</a></li>
            </ul>

        </div>

        <div class="service mt10">
            <h2>
                <span class="title1 on"><a href="/">话费</a></span>
                <span><a href="/">旅行</a></span>
                <span><a href="/">彩票</a></span>
                <span class="title4"><a href="/">游戏</a></span>
            </h2>
            <div class="service_wrap">
                <!-- 话费 start -->
                <div class="fare">
                    <form action="">
                        <ul>
                            <li>
                                <label for="">手机号：</label>
                                <input type="text" name="phone" value="请输入手机号" class="phone" />
                                <p class="msg">支持移动、联通、电信</p>
                            </li>
                            <li>
                                <label for="">面值：</label>
                                <select name="" id="">
                                    <option value="">10元</option>
                                    <option value="">20元</option>
                                    <option value="">30元</option>
                                    <option value="">50元</option>
                                    <option value="" selected>100元</option>
                                    <option value="">200元</option>
                                    <option value="">300元</option>
                                    <option value="">400元</option>
                                    <option value="">500元</option>
                                </select>
                                <strong>98.60-99.60</strong>
                            </li>
                            <li>
                                <label for="">&nbsp;</label>
                                <input type="submit" value="点击充值" class="fare_btn" /> <span><a href="/">北京青春怒放独家套票</a></span>
                            </li>
                        </ul>
                    </form>
                </div>
                <!-- 话费 start -->

                <!-- 旅行 start -->
                <div class="travel none">
                    <ul>
                        <li>
                            <a href="/">
                                <?=\yii\helpers\Html::img("@web/images/holiday.jpg")?>
                            </a>
                            <a href="/" class="button">度假查询</a>
                        </li>
                        <li>
                            <a href="/">
                                <?=\yii\helpers\Html::img("@web/images/scenic.jpg")?>
                            </a>
                            <a href="/" class="button">景点查询</a>
                        </li>
                    </ul>
                </div>
                <!-- 旅行 end -->

                <!-- 彩票 start -->
                <div class="lottery none">
                    <p>
                        <?=\yii\helpers\Html::img("@web/images/lottery.jpg")?>
                    </p>
                </div>
                <!-- 彩票 end -->

                <!-- 游戏 start -->
                <div class="game none">
                    <ul>
                        <li><a href="/"><?=\yii\helpers\Html::img("@web/images/sanguo.jpg")?></a></li>
                        <li><a href="/"><?=\yii\helpers\Html::img("@web/images/taohua.jpg")?></a></li>
                        <li><a href="/"><?=\yii\helpers\Html::img("@web/images/wulin.jpg")?></a></li>
                    </ul>
                </div>
                <!-- 游戏 end -->
            </div>
        </div>

    </div>
EOF;

   }
}