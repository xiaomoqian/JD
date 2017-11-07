<?php

namespace backend\controllers;

use backend\models\Brand;
use backend\models\GoodsCategory;
use backend\models\GoodsDayCount;
use backend\models\Goos;
use backend\models\GoosImg;
use backend\models\GoosDetails;
use flyok666\qiniu\Qiniu;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\data\Pagination;

class GoodsController extends \yii\web\Controller
{
    /*
     * 富文本编辑框
     */
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
     * 商品列表显示
     */
    public function actionIndex()
    {
        //设置分页
        $count=Goos::find()->count();
        $pageSize=3;
        $page=new Pagination([
            'pageSize'=>$pageSize,
            'totalCount'=>$count
        ]);
        $goods=Goos::find()->orderBy("id desc")->limit($page->limit)->offset($page->offset)->all();
        return $this->render('index',['goods'=>$goods,'page'=>$page]);
    }
    /*
     * 商品详情列表
     */
    public function actionSee($id){
        $details=GoosDetails::findOne(['goods_id'=>$id]);
        return $this->render('details',['details'=>$details]);
    }
    /*
     * 商品添加
     */
     public function actionAdd()
     {
         $model = new Goos();
         $detail = new GoosDetails();
         $imgs = new GoosImg();
         $day = new GoodsDayCount();
         $request = \Yii::$app->request;
         if ($request->isPost) {
             //数据绑定
             if ($model->load($request->post()) && $detail->load($request->post())) {
                 //数据验证
                 if ($model->validate() && $detail->validate()) {
                     if (!isset($model->sn)) {
                         $count = $count = Goos::find()->count();
                         $nowcount = "0000" . $count;
                         $nowcount = substr($nowcount, -5, 5);
                         $model->sn = date('Ymd') . $nowcount + 1;
                     }

                     $model->save();
                     $s = $request->post()['Goos']['imgFile'];
                     //多文件保存
                     foreach ($s as $k => $v) {
                         $imgs = new GoosImg();
                         //商品图片
                         $imgs->goobs_id = $model->id;
                         $imgs->img = $v;
                         $imgs->save();
                     }
                     //每天建表统计
                     $s = date("Ymd");
                     if (!GoodsDayCount::find(['day' => $s])->count()) {
                         $day->day = date("Ymd");
                     } else {
                         $day = GoodsDayCount::findOne(['day' => $s]);
                     }
                     $day->count = Goos::find()->count();
                     $day->save();
                     //商品详情
                     $detail->goods_id = $model->id;
                     $detail->save();
                     \Yii::$app->session->setFlash('success', '添加成功');
                     return $this->redirect(['index']);
                 }
             }
         }
         //商品分类
         $cates=GoodsCategory::find()->asArray()->all();
         $cate=Json::encode($cates);
         //商品品牌
         $brand=Brand::find()->all();
         $arrbrand=ArrayHelper::map($brand,'id','name');
         $model->stock=0;
         $model->status=1;
         $model->sale=1;
         return $this->render("add",['model'=>$model,'arrbrand'=>$arrbrand,'cates'=>$cate,'detail'=>$detail,'img'=>$imgs]);
     }
    /*
    * 商品修改
    */
    public function actionEdit($id)
    {
        $model=Goos::findOne($id);
        $img=$model->logo;
        $detail =GoosDetails::findOne(['goods_id'=>$id]);
        $imgs=GoosImg::find()->where(['goobs_id'=>$id])->all();
        $request = \Yii::$app->request;
        if ($request->isPost) {
            //数据绑定
            if ($model->load($request->post()) && $detail->load($request->post())) {
                //数据验证
                if ($model->validate() && $detail->validate()) {
                    if (!isset($model->sn)) {
                        $count = $count = Goos::find()->count();
                        $nowcount = "0000" . $count;
                        $nowcount = substr($nowcount, -5, 5);
                        $model->sn = date('Ymd') . $nowcount + 1;
                    }

                    $model->save();
                    $ss= $request->post()['Goos']['imgFile'];
                    $imgs=GoosImg::find()->where(['goobs_id'=>$id])->all();
                    foreach ($imgs as $k){
                        $k->delete();
                    }
                    //多文件保存
                    foreach ($ss as $k => $v) {
                        //商品图片
                        $imgs=new GoosImg();
                        $imgs->goobs_id = $model->id;
                        $imgs->img = $v;
                        $imgs->save();
                    }
                    //商品详情
                    $detail->goods_id = $model->id;
                    $detail->save();
                    \Yii::$app->session->setFlash('success', '添加成功');
                    return $this->redirect(['index']);
                }
            }
        }
        //商品分类
        $cates=GoodsCategory::find()->asArray()->all();
        $cate=Json::encode($cates);
        //商品品牌
        $brand=Brand::find()->all();
        $arrbrand=ArrayHelper::map($brand,'id','name');
         foreach ($imgs as $img){
           $model->imgFile[]=$img->img;
         }
        return $this->render("add",['model'=>$model,'arrbrand'=>$arrbrand,'cates'=>$cate,'detail'=>$detail]);
    }
    /*
     * 商品删除
     *
     */
    public function actionDel($id)
    {
        $del=Goos::findOne($id);
        $img=GoosImg::find()->where(['goobs_id'=>$id])->all();
        $details=GoosDetails::findOne(['goods_id'=>$id]);
         if($del){
             if($img){
                 foreach ($img as $k){
                     $k->delete();
                 }
             }
             if($details){
                 $details->delete();
             }
             $del->delete();
             \Yii::$app->session->setFlash('success','删除成功');
             return $this->redirect(['index']);
         }else{
             echo "<script>alert('删除失败')</script>";
         }
    }
    /*
     * 商品详情修改
     */
    public function actionDetailsEdit($id)
    {
        $details=GoosDetails::findOne(['goods_id'=>$id]);
        $request=\Yii::$app->request;
        if($request->isPost){
            if($details->load($request->post())){
                if($details->validate()){
                    $details->save();
                    \Yii::$app->session->setFlash('success','修改成功');
                    return $this->redirect(['see','id'=>$details->goods_id]);
                }
            }
        }
        return $this->render('details', ['edit' => $details]);
    }
}
