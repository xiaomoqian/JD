<?php

namespace backend\controllers;

use backend\models\Brand;
use xj\uploadify\UploadAction;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\Session;
use yii\web\UploadedFile;
use flyok666\qiniu\Qiniu;

class BrandController extends \yii\web\Controller
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
     * 显示列表
     * 设置分页
     */
    public function actionIndex()
    {
        //设置分页
        $count=Brand::find()->where(["!=",'status','-1'])->count();
        $pageSize=4;
        $page=new Pagination([
               'pageSize'=>$pageSize,
               'totalCount'=>$count
            ]);
        $rows=Brand::find()->orderBy('id desc')->where(["!=",'status','-1'])->limit($page->limit)->offset($page->offset)->all();
        return $this->render('index',['rows'=>$rows,'page'=>$page]);

    }
    /*
     * 显示回收站
     */
    public function actionYin()
    {
        //设置分页
        $count=Brand::find()->where(["=",'status','-1'])->count();
        $pageSize=4;
        $page=new Pagination([
            'pageSize'=>$pageSize,
            'totalCount'=>$count
        ]);
        $rows=Brand::find()->where(["=",'status','-1'])->orderBy('id desc')->limit($page->limit)->offset($page->offset)->all();

        return $this->render('index',['rows'=>$rows,'page'=>$page,'yin'=>1]);

    }
    /*
     * 添加品牌
     */
    public function actionAdd()
    {
       $model=new Brand();
       $request=\Yii::$app->request;
       if($request->isPost){
           if($model->load($request->post())){
               //验证数据
               if($model->validate()){
                       $session=\Yii::$app->session;
                       $model->save();
                       $session->setFlash('success','添加成功');
                        return $this->redirect(['index']);
               }
           }
       }
       $model->status=1;
       return $this->render('add',['model'=>$model]);
    }
    /*
     * 修改品牌
     */
    public function actionEdit($id)
    {
        $model=Brand::findOne($id);
        $img=$model->logo;
        $request=\Yii::$app->request;
        if($request->isPost){
            if($model->load($request->post())){
                //验证数据
                if($model->validate()){
                        $session=\Yii::$app->session;
                        $model->save();
                        $model->getDel($img,'qianqian');
                        $session->setFlash('success','修改成功');
                        return $this->redirect(['index']);
                }
            }
        }
        return $this->render('add',['model'=>$model]);
    }
    /*
     * 品牌回收
     *
     */
     public function actionStatus($id){
         $del=Brand::findOne($id);
             $del->status=1;
             $session=\Yii::$app->session;
             $del->save();
         $session->setFlash('success','还原成功');
         return $this->redirect(['yin']);
     }
    /*
     * 删除品牌
     */
    public function actionShanchu($id)
    {
        $del=Brand::findOne($id);
            $del->status=-1;
            $session=\Yii::$app->session;
            $del->save();
            $session->setFlash('success','删除成功');
            return $this->redirect(['index']);
    }
    /*
     * 一键删除onekey
     */
    public function actionOnekey()
    {
        $onekey=Brand::find()->all();
            foreach ($onekey as $v):
                $v->status = -1;
                $session=\Yii::$app->session;
                $v->save();
                $session->setFlash('success','删除成功');
            endforeach;
        return $this->redirect(['index']);
    }
    /*
     * 一键回收recovery
     */
    public function actionReco()
    {
        $reco=Brand::find()->all();
        foreach ($reco as $v):
            if($v->status=="-1"){
            $v->status=1;
            $session=\Yii::$app->session;
            $v->save();
            $session->setFlash('success','还原成功');
            }
        endforeach;
        return $this->redirect(['index']);

    }
    /*
     * 彻底删除
     */
    public function actionDel($id)
    {
        $del=Brand::findOne($id);
        $img=$del->logo;
        if($del){
            $del->delete();
            $del->getDel($img,'qianqian');
            $session=\Yii::$app->session;
            return $this->redirect(['yin']);
            $session->setFlash('success','删除成功');
        }else{
            echo "<script>alert('删除失败')</script>";
        }
    }
}
