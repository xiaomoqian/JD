<?php

namespace backend\controllers;

use backend\models\Admin;
use flyok666\qiniu\Qiniu;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Url;

class AdminController extends \yii\web\Controller
{
    /*
     * 图片上传
     */
    public function actionUpload()
    {
        $config = [
            'accessKey'=>'3QPn6N0S6AZeETy9Pn0gohcabRm7Mkasyf-uc7Yd',
            'secretKey'=>'J68RwhjP6rufO7Wik33GnPVyAtFzsyLLa7x7Vvhx',
            'domain'=>'http://oyw02vzfa.bkt.clouddn.com',
            'bucket'=>'qianqian',
            'area'=>Qiniu::AREA_HUANAN
        ];
        $qiniu = new Qiniu($config);
        $key = time();
        $qiniu->uploadFile($_FILES['file']['tmp_name'],$key);
        $url = $qiniu->getLink($key);
        $info=[
            'code'=>0,
            'url'=>$url,
            'attachment'=>$url
        ];
        exit(Json::encode($info));
    }
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
            if($admin){
                //验证密码是否正确
                if(\Yii::$app->security->validatePassword($re['Admin']['password'],$admin->password)){
                    $admin->token=\Yii::$app->security->generateRandomString();
                    $admin->update_at=time();
                    $admin->login_ip=\Yii::$app->request->getUserIP();
                    $admin->save();
                    if(!$re['Admin']['rememberMe']){
                        \Yii::$app->user->login($admin);
                    }else{
                        \Yii::$app->user->login($admin,3600*24*7);
                    }
                    return $this->redirect(['admin']);
                }else{
                    $model->addError('password','密码错误');
                }
            }else{
                $model->addError('username','用户名不存在');
            }

        }
        return $this->render("login",['model'=>$model]);
    }
    /*
     * 退出登录
     */
    public function actionLoginOut()
    {
        \Yii::$app->user->logout();
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
        //实例化rabc对象
        $auth=\Yii::$app->authManager;
        $request=\Yii::$app->request;
        if($request->isPost){
            //数据绑定
            if($model->load($request->post())){
                $model->password=\Yii::$app->security->generatePasswordHash($model->password);
               if($model->validate()){
                   $model->save();
                   if($model->role){
                       //循环找到角色
                       foreach ($model->role as $role){
                           //找到角色
                           $roles=$auth->getRole($role);
                           //把当前用户追加到当前角色中
                           $auth->assign($roles,$model->id);
                       }
                   }
                   \Yii::$app->session->setFlash("success","注册成功");
                   return $this->redirect(['admin']);
               }
            }
        }
        //获取所有角色
        $role=$auth->getRoles();
        $role=ArrayHelper::map($role,'name','description');
        return $this->render("add",['model'=>$model,'role'=>$role]);
    }
    /*
     * 用户修改
     */
    public function actionEdit($id){
        $model=Admin::findOne($id);
        $request=\Yii::$app->request;
        //实例化rabc对象
        $auth=\Yii::$app->authManager;
        //找到所有的角色
        $roles=$auth->getRolesByUser($id);
        //取出所有数字值
        $model->role=array_keys($roles);
        if($request->isPost){
            //数据绑定
            if($model->load($request->post())){
                if($model->password){
                    $model->password=\Yii::$app->security->generatePasswordHash($model->password);
                    if($model->validate()){
                        $model->save();
                        //删除当前全部角色
                        $auth->revokeAll($id);
                        if($model->role){
                                //循环添加角色
                                foreach ($model->role as $role){
                                    //找到角色
                                    $roles=$auth->getRole($role);
                                    //把当前用户追加到当前角色中
                                    $auth->assign($roles,$model->id);
                                }
                        }
                        \Yii::$app->session->setFlash("success","修改成功");
                        return $this->redirect(['admin']);
                    }
                }else{
                    \Yii::$app->session->setFlash("warning",'密码不能为空');
                    return $this->refresh();
                }
            }
        }
        //得到当前用户所有的角色
        $role=$auth->getRoles();
        $role=ArrayHelper::map($role,'name','description');
        $model->password="";
        return $this->render("add",['model'=>$model,'role'=>$role]);
    }
    /*
     * 用户删除
     */
    public function actionDel($id)
    {
        $del=Admin::findOne($id);
        $auth=\Yii::$app->authManager;
        //删除所有角色
        $auth->revokeAll($id);
        if($del){
            $del->delete();
            \Yii::$app->session->setFlash("success","删除成功");
            return $this->redirect(['admin']);
        }else{
            echo "<script>alert('删除失败')</script>";
        }
    }

}
