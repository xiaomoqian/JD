<?php
/**
 * Created by PhpStorm.
 * User: SAMSUNG
 * Date: 2017/11/17
 * Time: 11:01
 */

namespace frontend\controllers;


use backend\models\GoodsCategory;
use backend\models\Goos;
use backend\models\GoosDetails;
use backend\models\GoosImg;
use dosamigos\qrcode\QrCode;
use frontend\models\Cart;
use frontend\models\Order;
use frontend\models\OrderDetail;
use frontend\models\Ress;
use yii\data\Pagination;
use yii\db\Exception;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Cookie;
use EasyWeChat\Foundation\Application;
class IndexController extends Controller
{
    public $enableCsrfValidation=false;
    public function actionIndex()
    {
        return $this->renderPartial('index');
    }
    /*
     * 显示商品
     */
    public function actionList($id)
    {
        //设置分页
        $count=Goos::find()->where(['cate_id'=>$id])->count();
        $pageSize=8;
        $page=new Pagination([
            'pageSize'=>$pageSize,
            'totalCount'=>$count
        ]);
        $cate=GoodsCategory::findOne($id);
        $cates=GoodsCategory::find()->where(['tree'=>$cate->tree])->andWhere(['>=','lft',$cate->lft])->andWhere(['<=','rgt',$cate->rgt])->asArray()->all();
        $catesId=array_column($cates,'id');
        $model=Goos::find()->where(['in','cate_id',$catesId])->limit($page->limit)->offset($page->offset)->all();
        return $this->renderPartial('list',compact('model','page'));
    }
    /*
     * 显示商品详情
     */
    public function actionGoods($id){
        $model=GoosDetails::findOne(['goods_id'=>$id]);
        $img=GoosImg::find()->where(['goobs_id'=>$id])->all();
        $goods=Goos::findOne($id);
        return $this->renderPartial('goods',compact('model','img','goods'));
    }
    /*
     * 购物车
     */
    public function actionFlow(){
        $request=\Yii::$app->request;
        $getCoke=\Yii::$app->request->cookies;
        if($request->isPost){
            $id=$request->post()['id'];
            $amount=$request->post()['amount'];
            //判断用户是否登录
            if(\Yii::$app->user->isGuest){
                //拼接数据 存为数组
                 $cart=[$id=>$amount];
                 //获取cookie中的数据
                $cookie=$getCoke->has("cart")?$getCoke->getValue('cart'):[];
                //判断购物中有没有当前商品
               if(key_exists($id,$cookie)){
                   $cookie[$id]+=$amount;
               }else{
                   $cookie[$id]=$amount;
               }
               //存入cookie中
              $setCookie=\Yii::$app->response->cookies;
               $cartCookie=new Cookie([
                   'name'=>'cart',
                   'value'=>$cookie,
                   'expire'=>time()+3600*24*10
               ]);
               $setCookie->add($cartCookie);
                return $this->redirect(['cart']);
            }else{
                //用户已经登录
                $carts=new Cart();
                //获取当前用户ID
                $user_id=\Yii::$app->user->getId();
                $goods_id=$request->post()['id'];
                $num=$request->post()['amount'];
                //判断数据是否存在
                if($model=Cart::findOne(['goods_id'=>$goods_id])){
                    $model->num+=$num;
                    $model->save();
                    return $this->redirect(['cart']);
                }else{
                    $carts->user_id=$user_id;
                    $carts->goods_id=$goods_id;
                    $carts->num=$num;
                    $carts->save();
                    return $this->redirect(['cart']);
                }
            }
        }

    }
    /*
     * 购物车显示
     */
    public function actionCart()
    {
        //判断用户是否登录
        if(\Yii::$app->user->isGuest){
            //得到coookie中的数据
            $getCoke=\Yii::$app->request->cookies;
            $carts=$getCoke->getValue('cart');
            $goods=[];
            if($carts){
                foreach ($carts as $id=>$amount){
                    $good=Goos::find()->where(['id'=>$id])->asArray()->one();
                    $good['num']=$amount;
                    $goods[]=$good;
                }
            }
            return $this->renderPartial('flow',compact('goods'));
        }else{
            //用户已经登录
            $models=Cart::find()->where(['user_id'=>\Yii::$app->user->getId()])->all();
            $goods=[];
            foreach ($models as $model){
               $good=Goos::find()->where(['id'=>$model->goods_id])->asArray()->one();
               $good['num']=$model->num;
               $goods[]=$good;
            }
            return $this->renderPartial('flow',compact('goods'));
        }
    }
    /*
     * 添加减少购物车数据
     */
    public function actionChangeCart(){
        $request=\Yii::$app->request;
        if($request->isPost){
            $id=$request->post()['id'];
            $amount=$request->post()['num'];
            //判断用户是否登录
            if(\Yii::$app->user->isGuest){
                //获取cookie中的数据
                $getCoke=\Yii::$app->request->cookies;
                $cookie=$getCoke->getValue('cart');
                $cookie[$id]=$amount;
                //存入cookie中
                $setCookie=\Yii::$app->response->cookies;
                $cartCookie=new Cookie([
                    'name'=>'cart',
                    'value'=>$cookie,
                    'expire'=>time()+3600*24*10
                ]);
                $setCookie->add($cartCookie);
            }else{
                //用户也登录
                $carts=new Cart();
                //获取当前用户ID
                $user_id=\Yii::$app->user->getId();
                //判断数据是否存在
                if($model=Cart::findOne(['goods_id'=>$id])){
                    $model->num=$amount;
                    $model->save();
                }else{
                    $carts->user_id=$user_id;
                    $carts->goods_id=$id;
                    $carts->num=$amount;
                    $carts->save();
                }
            }
        }
    }
    /*
     * 删除购物车数据
     */
    public function actionRemove($id){
        //判断是否登录
        if(\Yii::$app->user->isGuest){
            //没登录
            $cookie=\Yii::$app->request->cookies;
            $carts=$cookie->getValue('cart');
            foreach ($carts as $cart=>$v){
                   if($cart=="{$id}"){
                        unset($carts[$cart]);
                     }
            }
            //存入cookie中
            $setCookie=\Yii::$app->response->cookies;
            $cartCookie=new Cookie([
                'name'=>'cart',
                'value'=>$carts,
                'expire'=>time()+3600*24*10
            ]);
            $setCookie->add($cartCookie);
        }else{
            //用户已经登录
            $cart=Cart::findOne(['goods_id'=>$id,'user_id'=>\Yii::$app->user->getId()]);
            if($cart){
                $cart->delete();
            }
        }
        return $this->redirect(['cart']);
    }
    /*
     * 购物车结算
     */
    public function actionOrder(){
        //用户是否登录
        if(\Yii::$app->user->isGuest){
            return $this->redirect(['user/login','url'=>'index/order']);
        }
        $user_id=\Yii::$app->user->getId();
        $ress=Ress::find()->where(['user_id'=>$user_id])->all();
        $carts=Cart::find()->where(['user_id'=>$user_id])->all();
        //是否有商品
        if(empty($carts)){
           echo "<script>alert('没有商品');window.location.href='cart'</script>";

        }
        $goods=[];
        foreach ($carts as $cart){
            $good=Goos::find()->where(['id'=>$cart->goods_id])->asArray()->one();
            $good['num']=$cart->num;
            $goods[]=$good;
        }
        //快递方式
        $express=\Yii::$app->params['express'];
        //支付方式
        $pay=\Yii::$app->params['pay_type'];
        return $this->renderPartial('flow2',compact('ress','goods','express','pay'));
    }

    /*
     * 提交订单
     */
    public function actionSubmit(){
        $request=\Yii::$app->request;


        if($request->isPost){
            //开启事物
            $transaction =\Yii::$app->db->beginTransaction();
            try{
                $id=$request->post();
                //订单对象
                $order=new Order();
                //获取地址
                $ress=Ress::findOne($id['ress']);
                //获取配送方式
                $express=\Yii::$app->params['express'][$id['express']-1];
                //获取支付方式
                $pay=\Yii::$app->params['pay_type'][$id['pay']];
                //获取当前用户购买的商品
                $user_id=\Yii::$app->user->getId();
                $carts=Cart::find()->where(['user_id'=>$user_id])->all();
                $num=0;

                //打开一个文件---->添加一个文件锁
//                $f=fopen('@web/data.txt','r+');
                //给文件上锁
//                flock($f,LOCK_EX);
//                sleep(1);
//                if(flock($f,LOCK_EX)){



                foreach ($carts as $k=>$cart){
                    $goods=Goos::find()->where(['id'=>$cart['goods_id']])->one();
                    if($cart['num']>$goods->stock){
                        //抛出异常
                        throw new Exception($goods->name."库存不足,请重新下单");
                        }
                    $num+=$goods->shop_price*$cart['num'];
                }
                $order->user_id=$user_id;
                $order->user_name=$ress->name;
                $order->province_name=$ress->province;
                $order->city_name=$ress->city;
                $order->area_name=$ress->county;
                $order->detail_address=$ress->address;
                $order->tel=$ress->mobile;
                $order->delivery_id=$express['express_id'];
                $order->delivery_name=$express['express_name'];
                $order->delivery_price=$express['express_price'];
                $order->pay_id=$id['pay'];
                $order->pay_name=$pay;
                $order->price=$num+$express['express_price'];
                $order->status=1;
                $order->trade_no=time().mt_rand(100,200).$user_id;
                if($order->save()==false){
                    throw new Exception('购买失败');
                }
                //订单详情对象
                foreach ($carts as $k=>$cart){
                    $order_detail=new OrderDetail();
                    $goods=Goos::find()->where(['id'=>$cart['goods_id']])->one();
                    //订单详情添加
                    $order_detail->reder_id=$order->id;
                    $order_detail->goods_id=$goods->id;
                    $order_detail->goods_name=$goods->name;
                    $order_detail->logo=$goods->logo;
                    $order_detail->price=$goods->shop_price;
                    $order_detail->amount=$cart['num'];
                    $order_detail->total_price=$goods->shop_price*$cart['num'];
                    if($order_detail->save()==false){
                        throw new Exception('购买失败');
                    }
                    //减少库存
                    $goods->stock-=$cart['num'];
                    $goods->save();
                }
                //3.清空购物车
                Cart::deleteAll(['user_id'=>$user_id]);
                $transaction->commit();//事务提交
                //打开文件锁

//                }fclose($f);
            } catch (Exception $e) {
                   $transaction->rollBack();//事务回滚
                echo "<script>alert('".$e->getMessage()."');location.href='order'</script>";
            }
        }

        return $this->renderPartial('flow3');
    }
    /*
     * 完成统一下单
     */
    public function actionPay($orderId){
        //查询当前订单
        $orderModel=Order::findOne($orderId);
        $orderDetail=OrderDetail::find()->where(['reder_id'=>$orderId])->all();

        $app = new Application(\Yii::$app->params['wechat']);

        $payment =$app->payment;

        $attributes = [
            'trade_type'       => 'NATIVE', // JSAPI，NATIVE，APP...
            'body'             => '今夕商城',
            'detail'           => '充气娃··',
            'out_trade_no'     => time().\Yii::$app->user->getId(),
            'total_fee'        => 1, // 单位：分
            'notify_url'       => Url::to(['ok'],true), // 支付结果通知网址，如果不设置则会使用配置里的默认地址
//            'openid'           => '当前用户的 openid', // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...
        ];

        //生成订单
        $order = new \EasyWeChat\Payment\Order($attributes);

        //调用微信接口统一下单
        $result = $payment->prepare($order);

        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;

            header('Content-Type: image/png');

            return \dosamigos\qrcode\QrCode::png($result->code_url,false,3,5);

        }
    }
    //调用视图（二维码生成）
    public function actionDemo()
    {
        return $this->render('flow3');
    }
    //用户支付成功
    public function actionOk(){
        $app = new Application(\Yii::$app->params['wechatOption']);
        $response = $app->payment->handleNotify(function($notify, $successful){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            // $order = 查询订单($notify->out_trade_no);
            //查询是否存在此订单
            $order=Order::find()->where(['trade_no'=>$notify->out_trade_no])->one();
            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->status!=1) { // 如果不是等付款就说明已经操作
                return true; // 已经支付成功了就不再更新了
            }
            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                // $order->paid_at = time(); // 更新支付时间为当前时间
                $order->status = 2;
            } else { // 用户支付失败
                // $order->status = 'paid_fail';
            }
            $order->save(); // 保存订单
            return true; // 返回处理完成
        });
        return $response;
    }
}