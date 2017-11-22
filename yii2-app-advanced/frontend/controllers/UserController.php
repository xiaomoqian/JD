<?php

namespace frontend\controllers;

use Aliyun\Sms;
use frontend\models\Cart;
use frontend\models\User;
use Mrgoon\AliSms\AliSms;

class UserController extends \yii\web\Controller
{   /*
    * 默认路径
   */
    public $layout="logon";
    /*
     * 免费注册
     */
    public function actionIndex()
    {
        $model=new User();
        $request=\Yii::$app->request;
        $session=\Yii::$app->session;
        if($request->isPost){
            $p=$request->post();
            if(!$p['User']['password_hash']){
                echo "<script>alert('密码不能为空');window.location.href ='index'</script>";
            }
            if($p['User']['password_hash']!=$p['password']){
                echo "<script>alert('两次密码不一致');window.location.href ='index'</script>";
            }
            //判断用户名是否存在
            if(!empty(User::find()->where(['username'=>$p['User']['username']])->all())){
                echo "<script>alert('用户名也存在');window.location.href ='index'</script>";

            }
            if($model->load($p)&& $model->validate() ){
                $password=\Yii::$app->security->generatePasswordHash($model->password_hash);
                $model->password_hash=$password;
                $model->save();
                return $this->redirect(['index/index']);
            }
        }
        return $this->render('index');
    }
    /*
     * 手机验证码
     */
    public function actionYz($tel)
    {
        $config = [
            'access_key' => 'LTAIfuZ622dcb00p',
            'access_secret' => 'jvAXMsh9rgx8r6iXbjvRcOSayG30EY',
            'sign_name' => '莫见成',
        ];
        if(!empty($tel)){
            //生成A-Z，0-9 的数组
            $str = array_merge(range('A','Z'),range(0,9));
            //打乱数组元素排序
            shuffle($str);
            //数组中根据条件取出4个元素值，转成字符串
            $codeContent = implode('',array_slice($str,0,4));
            $sms=new AliSms();
            $response = $sms->sendSms($tel, 'SMS_109445289', ['code'=> $codeContent], $config);
            if($response->Message=='OK'){
               \Yii::$app->session->set($tel,$codeContent);
            }
        }
     }
     /*
      * 登录
      */
     public function actionLogin(){
         $request=\Yii::$app->request;
         if($request->isPost){
             $post=$request->post();

             $url=$request->get('url')?$request->get('url'):"index/index";

             $model=User::findOne(["username"=>$post['User']['username']]);
            if(empty($model)){
                echo "<script>alert('用户名不存在');window.location.href ='login'</script>";
            }
            //判断密码是否正确
            if(\Yii::$app->security->validatePassword($post['User']['password_hash'],$model->password_hash)==true){
                $model->auth_key=\Yii::$app->security->generateRandomString();
                $model->login_at=time();
                $model->login_ip=ip2long(\Yii::$app->request->getUserIP());
                $model->save();
                //查询cookie中的值，把值保持到数据库中
                $cookie=\Yii::$app->request->cookies;
                $carts=$cookie->getValue('cart');
                if($carts){
                    foreach ($carts as $k=>$v){
                        $cart=new Cart();
                        if($m=Cart::findOne(['goods_id'=>$k,'user_id'=>\Yii::$app->user->getId()])){
                            $m->num=$v;
                            $m->save();
                        }else{
                            $cart->goods_id=$k;
                            $cart->user_id=$model->id;
                            $cart->num=$v;
                            $cart->save();
                        }
                    }
                   \Yii::$app->response->cookies->remove('cart');
                }
                if(empty($post['User']['auth_key'])){
                  \Yii::$app->user->login($model);
                }else{
                   \Yii::$app->user->login($model,3600*24*7);
                }
                return $this->redirect([$url]);
            }else{
                echo "<script>alert('密码错误');window.location.href ='login'</script>";
            }

         }
        return $this->render('login');
     }
    /*
    * 退出登录
    */
    public function actionOut()
    {
        \Yii::$app->user->logout();
        return $this->redirect(['login']);
    }
}
