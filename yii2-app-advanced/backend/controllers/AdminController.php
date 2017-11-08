<?php

namespace backend\controllers;

use backend\models\Admin;
use yii\data\Pagination;

class AdminController extends \yii\web\Controller
{
    /*
     * 用户登录
     */
    public function actionIndex()
    {
        $model=new Admin();
        $request=\Yii::$app->request;
        if($request->isPost){
            $re=$request->post();
            //验证用户是否存在
            $admin=Admin::findOne(['username'=>$re['Admin']['username']]);
            if(!$admin){
                echo "<script>alert('用户不存在！')</script>";
            }
            //验证密码是否正确
            if(\Yii::$app->security->validatePassword($re['Admin']['password'],$admin->password)){
                $admin->token=\Yii::$app->security->generateRandomString();
                $admin->update_at=time();
                $admin->login_ip=\Yii::$app->request->getUserIP();
                $admin->save();
                \Yii::$app->user->login($admin,3600*24*30);
                return $this->redirect(['admin']);
            }else{
                echo "<script>alert('密码错误！')</script>";
            }

        }
        return $this->render("login",['model'=>$model]);
    }
    /*
     * 退出登录
     */
    public function actionLoginOut()
    {
        $admin=Admin::findOne(2);
        \Yii::$app->user->logout($admin);
        return $this->redirect(['index']);
    }

    /*
     * 用户列表
     */
    public function actionAdmin()
    {
        $count=Admin::find()->count();
        $pageSize=5;
        $page=new Pagination([
            'pageSize'=>$pageSize,
            'totalCount'=>$count
        ]);
        $admins=Admin::find()->orderBy("id desc")->limit($page->limit)->offset($page->offset)->all();
        return $this->render('index',['admins'=>$admins,'page'=>$page]);
    }
    /*
     * 用户注册
     */
    public function actionAdd(){
        $model=new Admin();
        $request=\Yii::$app->request;
        if($request->isPost){
            //数据绑定
            if($model->load($request->post())){
                $model->password=\Yii::$app->security->generatePasswordHash($model->password);
               if($model->validate()){
                   $model->save();
                   \Yii::$app->session->setFlash("success","注册成功");
                   return $this->redirect(['admin']);
               }
            }
        }
        return $this->render("add",['model'=>$model]);
    }
    /*
     * 用户修改
     */
    public function actionEdit($id){
        $model=Admin::findOne($id);
        $request=\Yii::$app->request;
        if($request->isPost){
            //数据绑定
            if($model->load($request->post())){
                $model->password=\Yii::$app->security->generatePasswordHash($model->password);
                if($model->validate()){
                    $model->save();
                    \Yii::$app->session->setFlash("success","修改成功");
                    return $this->redirect(['admin']);
                }
            }
        }
        return $this->render("add",['model'=>$model]);
    }
    /*
     * 用户删除
     */
    public function actionDel($id)
    {
        $del=Admin::findOne($id);
        if($del){
            $del->delete();
            \Yii::$app->session->setFlash("success","删除成功");
            return $this->redirect(['admin']);
        }else{
            echo "<script>alert('删除失败')</script>";
        }
    }
}
