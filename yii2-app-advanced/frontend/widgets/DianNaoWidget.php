<?php
/**
 * Created by PhpStorm.
 * User: SAMSUNG
 * Date: 2017/11/17
 * Time: 21:44
 */

namespace frontend\widgets;


use yii\base\Widget;

class DianNaoWidget extends Widget
{
    public function run()
    {
        return <<<EOF
      <div class="floor1 floor w1210 bc mt10">
    <!-- 1F 左侧 start -->
    <div class="floor_left fl">
        <!-- 商品分类信息 start-->
        <div class="cate fl">
            <h2>电脑、办公</h2>
            <div class="cate_wrap">
                <ul>
                    <li><a href="/"><b>.</b>外设产品</a></li>
                    <li><a href="/"><b>.</b>鼠标</a></li>
                    <li><a href="/"><b>.</b>笔记本</a></li>
                    <li><a href="/"><b>.</b>超极本</a></li>
                    <li><a href="/"><b>.</b>平板电脑</a></li>
                    <li><a href="/"><b>.</b>主板</a></li>
                    <li><a href="/"><b>.</b>显卡</a></li>
                    <li><a href="/"><b>.</b>打印机</a></li>
                    <li><a href="/"><b>.</b>一体机</a></li>
                    <li><a href="/"><b>.</b>投影机</a></li>
                    <li><a href="/"><b>.</b>路由器</a></li>
                    <li><a href="/"><b>.</b>网卡</a></li>
                    <li><a href="/"><b>.</b>交换机</a></li>
                </ul>
                <p><a href="/">
                        <img src="/images/notebook.jpg" alt="">
                    </a></p>
            </div>


        </div>
        <!-- 商品分类信息 end-->

        <!-- 商品列表信息 start-->
        <div class="goodslist fl">
            <h2>
                <span class="on">推荐商品</span>
                <span>精品</span>
                <span>热卖</span>
            </h2>
            <div class="goodslist_wrap">
                <div>
                    <ul>
                        <li>
                            <dl>
                                <dt><a href="/">
                                        <img src="/images/hpG4.jpg" alt="">
                                    </a></dt>
                                <dd><a href="/">惠普G4-1332TX 14英寸笔</a></dd>
                                <dd><span>售价：</span> <strong>￥2999.00</strong></dd>
                            </dl>
                        </li>

                        <li>
                            <dl>
                                <dt><a href="/">
                                        <img src="/images/thinkpad e420.jpg" alt="">
                                    </a></dt>
                                <dd><a href="/">ThinkPad E42014英寸笔..</a></dd>
                                <dd><span>售价：</span> <strong>￥4199.00</strong></dd>
                            </dl>
                        </li>

                        <li>
                            <dl>
                                <dt><a href="/">
                                        <img src="/images/acer4739.jpg" alt="">
                                    </a></dt>
                                <dd><a href="/">宏碁AS4739-382G32Mnk</a></dd>
                                <dd><span>售价：</span> <strong>￥2799.00</strong></dd>
                            </dl>
                        </li>

                        <li>
                            <dl>
                                <dt><a href="/">
                                        <img src="/images/samsung6800.jpg" alt="">
                                    </a></dt>
                                <dd><a href="/">三星Galaxy Tab P6800.</a></dd>
                                <dd><span>售价：</span> <strong>￥4699.00</strong></dd>
                            </dl>
                        </li>

                        <li>
                            <dl>
                                <dt><a href="/">
                                        <img src="/images/lh531.jpg" alt="">
                                    </a></dt>
                                <dd><a href="/">富士通LH531 14.1英寸笔记</a></dd>
                                <dd><span>售价：</span> <strong>￥2189.00</strong></dd>
                            </dl>
                        </li>

                        <li>
                            <dl>
                                <dt><a href="/">
                                        <img src="/images/qinghuax2.jpg" alt="">
                                    </a></dt>
                                <dd><a href="/">清华同方精锐X2笔记本 </a></dd>
                                <dd><span>售价：</span> <strong>￥2499.00</strong></dd>
                            </dl>
                        </li>
                    </ul>
                </div>

                <div class="none">
                    <ul>
                        <li>
                            <dl>
                                <dt><a href="/">
                                        <img src="/images/hpG4.jpg" alt="">
                                    </a></dt>
                                <dd><a href="/">惠普G4-1332TX 14英寸笔</a></dd>
                                <dd><span>售价：</span> <strong>￥2999.00</strong></dd>
                            </dl>
                        </li>

                        <li>
                            <dl>
                                <dt><a href="/"><img src="/images/qinghuax2.jpg" alt=""></a></dt>
                                <dd><a href="/">清华同方精锐X2笔记本 </a></dd>
                                <dd><span>售价：</span> <strong>￥2499.00</strong></dd>
                            </dl>
                        </li>

                    </ul>
                </div>

                <div class="none">
                    <ul>
                        <li>
                            <dl>
                                <dt><a href="/"><img src="/images/thinkpad e420.jpg" alt=""></a></dt>
                                <dd><a href="/">ThinkPad E42014英寸笔..</a></dd>
                                <dd><span>售价：</span> <strong>￥4199.00</strong></dd>
                            </dl>
                        </li>

                        <li>
                            <dl>
                                <dt><a href="/"><img src="/images/acer4739.jpg" alt=""></a></dt>
                                <dd><a href="/">宏碁AS4739-382G32Mnk</a></dd>
                                <dd><span>售价：</span> <strong>￥2799.00</strong></dd>
                            </dl>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- 商品列表信息 end-->
    </div>
    <!-- 1F 左侧 end -->

    <!-- 右侧 start -->
    <div class="sidebar fl ml10">
        <!-- 品牌旗舰店 start -->
        <div class="brand">
            <h2><a href="/">更多品牌&nbsp;></a><strong>品牌旗舰店</strong></h2>
            <div class="sidebar_wrap">
                <ul>
                    <li><a href="/"><img src="/images/dell.gif" alt=""></a></li>
                    <li><a href="/"><img src="/images/acer.gif" alt=""></a></li>
                    <li><a href="/"><img src="/images/fujitsu.jpg" alt=""></a></li>
                    <li><a href="/"><img src="/images/hp.jpg" alt=""></a></li>
                    <li><a href="/"><img src="/images/lenove.jpg" alt=""></a></li>
                    <li><a href="/"><img src="/images/samsung.gif" alt=""></a></li>
                    <li><a href="/"><img src="/images/dlink.gif" alt=""></a></li>
                    <li><a href="/"><img src="/images/seagate.jpg" alt=""></a></li>
                    <li><a href="/"><img src="/images/intel.jpg" alt=""></a></li>
                </ul>
            </div>
        </div>
        <!-- 品牌旗舰店 end -->

        <!-- 分类资讯 start -->
        <div class="info mt10">
            <h2><strong>分类资讯</strong></h2>
            <div class="sidebar_wrap">
                <ul>
                    <li><a href="/"><b>.</b>iphone 5s土豪金大量到货</a></li>
                    <li><a href="/"><b>.</b>三星note 3低价促销</a></li>
                    <li><a href="/"><b>.</b>thinkpad x240即将上市</a></li>
                    <li><a href="/"><b>.</b>双十一来临，众商家血拼</a></li>
                </ul>
            </div>

        </div>
        <!-- 分类资讯 end -->

        <!-- 广告 start -->
        <div class="ads mt10">
            <a href="/"><img src="/images/canon.jpg" alt=""></a>
        </div>
        <!-- 广告 end -->
    </div>
    <!-- 右侧 end -->

</div>
EOF;

  }
}