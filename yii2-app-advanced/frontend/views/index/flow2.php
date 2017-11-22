
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>填写核对订单信息</title>
    <link rel="stylesheet" href="/style/base.css" type="text/css">
    <link rel="stylesheet" href="/style/global.css" type="text/css">
    <link rel="stylesheet" href="/style/header.css" type="text/css">
    <link rel="stylesheet" href="/style/fillin.css" type="text/css">
    <link rel="stylesheet" href="/style/footer.css" type="text/css">

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script  src="/js/index.js"></script>
    <script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/js/cart2.js"></script>

</head>
<body>
<!-- 顶部导航 start -->
<?php include_once Yii::getAlias("@app/views/comment/top.php")?>
<!-- 顶部导航 end -->

<div style="clear:both;"></div>

<!-- 页面头部 start -->
<div class="header w990 bc mt15">
    <div class="logo w990">
        <h2 class="fl">
            <?=\yii\helpers\Html::a(\yii\helpers\Html::img("@web/images/logo.png",['alt'=>'今夕商城']),['index/index'])?>
        </h2>
        <div class="flow fr flow2">
            <ul>
                <li>1.我的购物车</li>
                <li class="cur">2.填写核对订单信息</li>
                <li>3.成功提交订单</li>
            </ul>
        </div>
    </div>
</div>
<!-- 页面头部 end -->

<div style="clear:both;"></div>




<!--订单提交start-->
<form action="submit" method="post">
<!-- 主体部分 start -->
<div class="fillin w990 bc mt15">
    <div class="fillin_hd">
        <h2>填写并核对订单信息</h2>
    </div>
    <!--填写并核对订单信息-->
    <div class="fillin_bd">
        <!-- 收货人信息  start-->
        <div class="address">
            <h3>收货人信息</h3>
            <div class="address_info">
                <input name="_csrf-frontend" type="hidden" id="_csrf-frontend" value="<?= Yii::$app->request->csrfToken ?>">
                <?php foreach ($ress as $k=>$v):?>
                        <p><input type="radio" value="<?=$v->id?>" name="ress" <?php if($v->status){ echo 'checked'; }?> /><?php echo $v->name." ".$v->province." ".$v->city." ".$v->county." ".$v->address." ".$v->mobile?></p>
                <?php endforeach;?>

            </div>
        <!-- 收货人信息  end-->

        <!-- 配送方式 start-->
        <div class="delivery">
            <h3>送货方式</h3>
            <div class="delivery_info">
                <table>
                    <tr >
                      <?php foreach ($express as $press):?>
                            <td >
                                <input type="radio" name="express" class="express" value="<?=$press['express_id']?>" price="<?=$press['express_price']?>" <?php if($press['express_id']=="3") echo 'checked="checked"'?> /><?=$press['express_name']?>[<?=$press['express_price']?>元/<?=$press['m']?>]
                                &nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
                       <?php endforeach;?>
                    </tr>
                </table>
            </div>
        </div>
        <!-- 配送方式end-->

        <!-- 支付方式-->
        <div class="pay">
            <h3>支付方式 </h3>
            <div class="pay_info">
                <table>
                    <tr >
                    <?php  foreach ($pay as $k=>$type):?>
                        <td class="col1">
                            <input type="radio" name="pay" value="<?=$k?>" <?php if($type=="支付宝") echo 'checked="checked"'?> /><?=$type?>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                        </td>
                    <?php endforeach;?>
                    </tr>
                </table>
            </div>
        </div>
        <!-- 支付方式  end-->

        <!-- 商品清单 start -->
        <div class="goods">
            <h3>商品清单</h3>
            <table>
                <thead>
                <tr>
                    <th class="col1">商品</th>
                    <th class="col3">价格</th>
                    <th class="col4">数量</th>
                    <th class="col5">小计</th>
                </tr>
                </thead>
                <tbody>

             <?php $m=0; $s=0;foreach ($goods as $good):?>
                 <?php $m+=$good['shop_price']*$good['num'];
                        $s+=$good['num'];
                 ?>
                <tr id="<?=$good['id']?>">
                    <td class="col1">
                   <?=\yii\helpers\Html::a(\yii\helpers\Html::img($good['logo']),['detail','id'=>$good['id']])?>
                        <strong>
                            <?=\yii\helpers\Html::a($good['name'],['detail','id'=>$good['id']])?>
                        </strong></td>
                    <td class="col3">￥<span><?=$good['shop_price']?></span></td>
                    <td class="col4"> <?=$good['num']?></td>
                    <td class="col5">￥<span><?=$good['shop_price']*$good['num']?></td>
                </tr>
             <?php endforeach;?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5">
                        <ul>
                            <li>
                                <span><?=$s;?>件商品，总商品金额：￥<span class="q"><?=$m;?></span>元</span>

                            </li>
<!--                            <li>-->
<!--                                <span>返现：￥0.00</span>-->
<!--                            </li>-->
                            <li>
                                <span >运费：￥<span id="yun"><?=\Yii::$app->params['express'][2]['express_price']?></span> .00元</span>

                            </li>
                            <li>
                                <span >应付总额：￥<span  class="total"><?=$m+\Yii::$app->params['express'][2]['express_price'];?></span>元</span>
                            </li>
                        </ul>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- 商品清单 end -->
    </div>
    <!--填写并核对订单信息end-->

     <!--商品提交-->
    <div class="fillin_ft">
        <?=\yii\helpers\Html::submitButton("<span></span>" ,['class'=>'o'])?>
        <p>应付总额：<strong>￥<span class="w"><?=$m+\Yii::$app->params['express'][2]['express_price'];?></span>元</strong></p>
    </div>
    <!--商品提交end-->
</div>
<!-- 主体部分 end -->
</form>
<!--订单结束end-->


<div style="clear:both;"></div>
<!-- 底部版权 start -->
<div class="footer w1210 bc mt15">
    <p class="links">
        <a href="">关于我们</a> |
        <a href="">联系我们</a> |
        <a href="">人才招聘</a> |
        <a href="">商家入驻</a> |
        <a href="">千寻网</a> |
        <a href="">奢侈品网</a> |
        <a href="">广告服务</a> |
        <a href="">移动终端</a> |
        <a href="">友情链接</a> |
        <a href="">销售联盟</a> |
        <a href="">京西论坛</a>
    </p>
    <p class="copyright">
        © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号
    </p>
    <p class="auth">
        <a href=""><img src="/images/xin.png" alt="" /></a>
        <a href=""><img src="/images/kexin.jpg" alt="" /></a>
        <a href=""><img src="/images/police.jpg" alt="" /></a>
        <a href=""><img src="/images/beian.gif" alt="" /></a>
    </p>
</div>
<!-- 底部版权 end -->
<script>
    //快递费用 总额
    $(function(){
        var total=0;
        $(".express").change(function(){
            $("#yun").text($(this).attr('price'));
            var q=$('.q').text();
            var y=$('#yun').text();
            total=parseFloat(q)+parseFloat(y);
            $(".total").text(total);
            $(".w").text(total);
        });
    })

</script>
</body>
</html>
