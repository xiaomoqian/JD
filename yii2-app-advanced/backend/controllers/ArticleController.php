<?php

namespace backend\controllers;

use backend\models\Article;
use backend\models\ArticleCateGory;
use backend\models\ArticleDetail;
use yii\helpers\ArrayHelper;

/*
 * 文章的分类与增删改查
 */
class ArticleController extends \yii\web\Controller
{
    /*
     * 查询分类
     */
    public function actionGory()
    {
        $rows=ArticleCateGory::find()->all();
        return $this->render('gory',['rows'=>$rows]);
    }

    /*
     * 查询文章列表
     */
    public function actionIndex()
    {
        $rows=Article::find()->orderBy("id desc")->all();
        return $this->render('index',['rows'=>$rows]);
    }
    /*
     * 查看内容
     */
    public function actionDetail($id)
    {
        $detail=ArticleDetail::findOne($id);
        return $this->render('detail',['details'=>$detail]);
    }
    /*
     * 分类添加
     */
    public function actionGa(){
        $model=new ArticleCateGory();
        $request=\Yii::$app->request;
        if($request->isPost){
            //文章添加
            if($model->load($request->post())){
                    if($model->validate()){
                        $model->save();
                        return $this->redirect(['gory']);
                    }
                }
        }
        $model->status=1;
        $model->is_htlp=1;
        return $this->render("ga",['model'=>$model]);
    }
    /*
     * 分类修改
     */
    public function actionGedit($id){
        $model=ArticleCateGory::findOne($id);
        $request=\Yii::$app->request;
        if($request->isPost){
            //文章添加
            if($model->load($request->post())){
                if($model->validate()){
                    $model->save();
                    return $this->redirect(['gory']);
                }
            }
        }
        return $this->render("ga",['model'=>$model]);
    }
    /*
     * 分类删除
     */
    public function actionGdel($id)
    {
        $del=ArticleCateGory::findOne($id);
        if($del){
            $del->delete();
            return $this->redirect(['gory']);
        }
    }
    /*
     * 文章添加
     */
   public function actionAdd(){
        $model=new Article();
        $detail=new ArticleDetail();
        $request=\Yii::$app->request;
        if($request->isPost){
            //文章添加
            if($model->load($request->post())){
             //文章内容添加
                if($detail->load($request->post())){
                   if($model->validate() && $detail->validate()){

                       $model->save();
                       $detail->detail_id=$model->id;
                       $detail->save();
                       return $this->redirect(['index']);
                   }
              }
            }
        }
        $gory=ArticleCateGory::find()->all();
        $arrgory=ArrayHelper::map($gory,'id','name');
        $model->status=1;
        return $this->render("add",['model'=>$model,'detail'=>$detail,'arrgory'=>$arrgory]);
   }
    /*
  * 文章修改
  */
    public function actionEdit($id){
        $model=Article::findOne($id);
        $request=\Yii::$app->request;
        if($request->isPost){
            //文章添加
            if($model->load($request->post())){
                    if($model->validate()){
                        $model->save();
                        return $this->redirect(['index']);
                    }
                }
            }
        $gory=ArticleCateGory::find()->all();
        $arrgory=ArrayHelper::map($gory,'id','name');
        return $this->render("add",['model'=>$model,'arrgory'=>$arrgory]);
    }
    /*
     * 内容修改
     */
    public function actionContent($id)
    {
        $content= ArticleDetail::findOne($id);
        $request=\Yii::$app->request;
        if($request->isPost){
                if($content->load($request->post())){
                    $content->save();
                    return $this->redirect(['detail','id'=>$id]);
                }
        }
        return $this->render('editcontent',['content'=>$content]);
    }
    /*
     * 文章删除
     */
    public function actionDel($id)
    {
        $del=Article::findOne($id);
        $detail=ArticleDetail::findOne($del->id);
        if($del){
            $del->delete();
            $detail->delete();
            return $this->redirect(['index']);
        }else{
            echo "<script>alert('删除失败')</script>";
        }
    }
}
