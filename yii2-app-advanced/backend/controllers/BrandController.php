<?php

namespace backend\controllers;

use backend\models\Brand;
use xj\uploadify\UploadAction;
use yii\web\Session;
use yii\web\UploadedFile;

class BrandController extends \yii\web\Controller
{
    /*
     * 文件上传
     */
    public function actions() {
        return [
            's-upload' => [
                'class' => UploadAction::className(),
                'basePath' => '@webroot/upload/brand',
                'baseUrl' => '@web/upload/brand',
                'enableCsrf' => true, // default
                'postFieldName' => 'Filedata', // default
                //BEGIN METHOD
                'format' => [$this, 'methodName'],
                //END METHOD
                //BEGIN CLOSURE BY-HASH
                'overwriteIfExist' => true,
                'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filename = sha1_file($action->uploadfile->tempName);
                    return "{$filename}.{$fileext}";
                },
                //END CLOSURE BY-HASH
                //BEGIN CLOSURE BY TIME
                'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filehash = sha1(uniqid() . time());
                    $p1 = substr($filehash, 0, 2);
                    $p2 = substr($filehash, 2, 2);
                    return "{$p1}/{$p2}/{$filehash}.{$fileext}";
                },
                //END CLOSURE BY TIME
                'validateOptions' => [
                    'extensions' => ['jpg', 'png','gif'],
                    'maxSize' => 1 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function (UploadAction $action) {
                    //throw new Exception('test error');
                },
                'afterValidate' => function (UploadAction $action) {},
                'beforeSave' => function (UploadAction $action) {},
                'afterSave' => function (UploadAction $action) {
                    $action->output['fileUrl'] = $action->getWebUrl();
                    $action->getFilename(); // "image/yyyymmddtimerand.jpg"
                    $action->getWebUrl(); //  "baseUrl + filename, /upload/image/yyyymmddtimerand.jpg"
                    $action->getSavePath(); // "/var/www/htdocs/upload/image/yyyymmddtimerand.jpg"
                },
            ],
        ];
    }
    /*
     * 显示列表
     */
    public function actionIndex()
    {
        $rows=Brand::find()->orderBy('id desc')->all();
        return $this->render('index',['rows'=>$rows]);
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
               //接收图片
               $model->imgFile=UploadedFile::getInstance($model,'imgFile');
               //验证数据
               if($model->validate()){
               //给文件添加后缀名
               $imgPath="upload/brand/".time().".".$model->imgFile->extension;
               //将文件保存到路径中
               $model->imgFile->saveAs($imgPath,false);
               //将文件保存到数据中
               $model->logo=$imgPath;
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
                //接收图片
                $model->imgFile=UploadedFile::getInstance($model,'imgFile');
                //验证数据
                if($model->validate()){
                    //给文件添加后缀名
                    $imgPath="upload/brand/".time().".".$model->imgFile->extension;
                    //将文件保存到路径中
                    $model->imgFile->saveAs($imgPath,false);
                    //将文件保存到数据中
                    $model->logo=$imgPath;
                    $session=\Yii::$app->session;
                    $model->save();
                    unlink($img);
                    $session->setFlash('success','修改成功');
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('add',['model'=>$model]);
    }
    /*
     * 删除品牌
     */
    public function actionDel($id)
    {
        $del=Brand::findOne($id);
        $img=$del->logo;
        if($del){
            $del->delete();
            unlink($img);
            return $this->redirect(['index']);
        }else{
            echo "<script>alert('删除失败')</script>";
        }
    }
}
