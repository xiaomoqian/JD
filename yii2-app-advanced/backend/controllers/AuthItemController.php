<?php

namespace backend\controllers;

use backend\models\AuthItem;
use yii\data\Pagination;

class AuthItemController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $autManager=\Yii::$app->authManager;
        $count=AuthItem::find()->where(["type"=>2])->count();
        $pageSize=10;
        $page=new Pagination([
            'pageSize'=>$pageSize,
            'totalCount'=>$count
        ]);
//        $pers=$autManager->getPermissions();
        $pers=AuthItem::find()->limit($page->limit)->offset($page->offset)->all();
        return $this->render('index',compact("pers","page"));
    }
    /*
     * 权限添加
     */
//    public function actionAdd()
//    {
//        $per=new AuthItem();
//        $request=\Yii::$app->request;
//        if($request->isPost){
//            if($per->load($request->post()) && $per->validate()){
//                $autManager=\Yii::$app->authManager;
//                //创建权限
//                $Permission=$autManager->createPermission($per->name);
//                //创建描述
//                $Permission->description=$per->description;
//                //添加到数据库
//                $autManager->add($Permission);
//                \Yii::$app->session->setFlash("success",'添加'.$Permission->description."成功");
//                return $this->redirect(['index']);
//            }
//        }
//        return $this->render("add",compact("per"));
//    }
    /*
     * 权限修改
     */
    public function actionEdit($name)
    {
        $per=AuthItem::findOne($name);
        $request=\Yii::$app->request;
        if($request->isPost){
            if($per->load($request->post()) && $per->validate()){
                //实例化rbac对象
                $autManager=\Yii::$app->authManager;
                //找出权限名称
                $Permission=$autManager->getPermission($per->name);
                if($Permission){
                    //创建描述
                    $Permission->description=$per->description;
                    //修改到数据库
                    $autManager->update($per->name,$Permission);
                    \Yii::$app->session->setFlash("success","修改".$per->name."权限成功");
                    return $this->redirect(['index']);
                }else{
                    \Yii::$app->session->setFlash("danger",'不能修改权限名称'.$per->name);
                    return $this->refresh();
                }

                \Yii::$app->session->setFlash("success",'添加'.$Permission->description."成功");
                return $this->redirect(['index']);
            }
        }
        return $this->render("add",compact("per"));
    }
    /*
     * 权限删除
     */
    public function actionDel($name)
    {
        $del=AuthItem::findOne($name);
        if($del){
            $del->delete();
            \Yii::$app->session->setFlash('success','删除'.$name."成功");
            return $this->redirect(['index']);
        }
    }
}
