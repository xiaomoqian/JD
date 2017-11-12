<?php

namespace backend\controllers;

use backend\models\AuthItem;
use yii\helpers\ArrayHelper;

class AuthRuleController extends \yii\web\Controller
{
    /*
     * 角色显示
     */
    public function actionIndex()
    {
        $autManager=\Yii::$app->authManager;
        $pers=$autManager->getRoles();
        return $this->render('index',compact("pers"));
    }
    /*
     * 角色删除
     */
    public function actionDel($name)
    {
        $aut=\Yii::$app->authManager;
        //找到当前要删除的角色
        $del=$aut->getRole($name);
        //删除当前角色的所有权限
        $aut->removeChildren($del);
        if($aut->remove($del)){
            \Yii::$app->session->setFlash('success','删除'.$name."成功");
            return $this->redirect(['index']);
        }
    }
    /*
     *角色添加
     */
//    public function actionAdd()
//    {
//        $per=new AuthItem();
//        $request=\Yii::$app->request;
//        $autManager=\Yii::$app->authManager;
//        if($request->isPost){
//            if($per->load($request->post()) && $per->validate()){
//                //创建权限
//                $rule=$autManager->createRole($per->name);
//                //创建描述
//                $rule->description=$per->description;
//                //将权限添加到数据库
//               if ( $autManager->add($rule)){
//                 //给角色添加权限
//                   if($per->permission){
//                       foreach ($per->permission as $permission){
//                           //循环给角色添加权限
//                           $autManager->addChild($rule,$autManager->getPermission($permission));
//                       }
//                       \Yii::$app->session->setFlash("success",'添加'.$rule->description."成功");
//                       return $this->redirect(['index']);
//                   }
//
//               }
//            }
//        }
//        $permissions=$autManager->getPermissions();
//        $permissions=ArrayHelper::map($permissions,'name','description');
//        return $this->render("add",compact("per",'permissions'));
//    }
    /*
     * 角色修改
     */
//    public function actionEdit($name)
//    {
//        $per = AuthItem::findOne($name);
//        $request = \Yii::$app->request;
//        //实例化rbac对象
//        $autManager = \Yii::$app->authManager;
//        //通过角色找出所有权限
//        $rolePer = $autManager->getPermissionsByRole($name);
//        //取数组所有键
//        $per->permission= array_keys($rolePer);
//        if ($request->isPost) {
//            if ($per->load($request->post()) && $per->validate()) {
//                //找出当前角色名称
//                $role = $autManager->getRole($per->name);
//                if ($role) {
//                    //创建描述
//                    $role->description = $per->description;
//                    //修改到数据库
//                    if ($autManager->update($per->name, $role)) {
//                        //删除当前角色权限
//                        $autManager->removeChildren($role);
//                        //给用户添加权限
//                        if ($per->permission) {
//                            foreach ($per->permission as $per) {
//                                //分别把权限名称添加到对应的角色中
//                                $autManager->addChild($role, $autManager->getPermission($per));
//                            }
//                        }
//                        \Yii::$app->session->setFlash("success", "修改" . $role->name . "角色成功");
//                        return $this->redirect(['index']);
//                    }
//                }else {
//                    \Yii::$app->session->setFlash("danger", '不能修改角色名称' );
//                    return $this->refresh();
//                }
//            }
//        }
//        $permissions=$autManager->getPermissions();
//        $permissions=ArrayHelper::map($permissions,'name','description');
//        return $this->render("add", compact("per","permissions"));
//    }

}
