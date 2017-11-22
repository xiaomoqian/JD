<?php

namespace frontend\controllers;

use frontend\models\Ress;

class RessController extends \yii\web\Controller
{
    /*
     * 添加地址
     */
    public function actionIndex()
    {
        $model=Ress::find()->orderBy('id desc')->all();
        $ress=new Ress();
        $request=\Yii::$app->request;
        if($request->isPost){
            if($ress->load($request->post()) && $ress->validators){
                $ress->user_id=\Yii::$app->user->identity->id;
                if(empty($request->post()['Ress']['status'])){
                    $ress->status=0;
                }else{
                    foreach ($model as $k=>$v){
                        $v->status=0;
                        $v->save();
                    }
                    $ress->status=1;
                }
                if($ress->save()){
                    return $this->redirect(['index']);
                }else{
                    var_dump($ress->getErrors());exit;
                }

            }
        }

        return $this->renderPartial('index',compact('model'));
    }
    /*
     * 编辑地址
     */
    public function actionEdit($id){
        $model=Ress::findOne($id);
        $request=\Yii::$app->request;
        if($request->isPost){
            if($model->load($request->post()) && $model->validators){
                $model->user_id=\Yii::$app->user->identity->id;
                if(empty($request->post()['Ress']['status'])){
                    $model->status=0;
                }else{
                    $ress=Ress::find()->all();
                    foreach ($ress as $k=>$v){
                        $v->status=0;
                        $v->save();
                    }
                    $model->status=1;
                }
                if($model->save()){
                    return $this->redirect(['index']);
                }else{
                    var_dump($model->getErrors());exit;
                }

            }
        }
        return $this->renderPartial('edit',compact('model'));
    }
    /*
     * 设置默认地址
     */
    public function actionDefault($id)
    {
        $model=Ress::findOne($id);
        if($model){
            $per=Ress::find()->all();
            foreach ($per as $k=>$v){
                $v->status=0;
                $v->save();
            }
            $model->status=1;
            $model->save();
            return $this->redirect('index');
        }
    }
   /*
    * 删除地址
    */
    public function actionDel($id)
    {
        $model=Ress::findOne($id);
        if($model){
            $model->delete();
            $model=Ress::find()->all();
            return $this->renderPartial('index',compact('model'));
        }
   }
}
