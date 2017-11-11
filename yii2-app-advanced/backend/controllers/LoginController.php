<?php
/**
 * Created by PhpStorm.
 * User: SAMSUNG
 * Date: 2017/11/11
 * Time: 18:27
 */

namespace backend\controllers;


use backend\models\Admin;
use yii\web\Controller;

class LoginController extends Controller
{
    //关闭表单提交验证
    public $enableCsrfValidation = false;
    public function actionIndex(){
        $request=\Yii::$app->request;
        if($request->isPost){
            $re=$request->post();
            //验证用户是否存在
            $admin=Admin::findOne(['username'=>$re['username']]);
            if($admin){
                if(!isset($re['password'])){
                    return $this->refresh();
                }
                //验证密码是否正确
                if(\Yii::$app->security->validatePassword($re['password'],$admin->password)){
                    $admin->token=\Yii::$app->security->generateRandomString();
                    $admin->update_at=time();
                    $admin->login_ip=\Yii::$app->request->getUserIP();
                    $admin->save();
                    if(!isset($re['rememberMe'])){
                        \Yii::$app->user->login($admin);
                    }else{
                        \Yii::$app->user->login($admin,3600*24*7);
                    }
                    return $this->redirect(['test/index']);
                }else{
                    echo "<script>alert('密码错误');window.location.href ='index'</script>";
//                   return $this->refresh();
                }
            }else{
                 echo "<script>alert('用户不存在');window.location.href ='index'</script>";
//                  return $this->refresh();
            }

        }
        return $this->renderPartial('login');
    }
    /*
     * 退出登录
     */
    public function actionOut()
    {
        \Yii::$app->user->logout();
        return $this->redirect(['index']);
    }
}