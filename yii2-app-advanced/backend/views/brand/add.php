<?php
use yii\web\JsExpression;
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name')->textInput(['placeholder'=>'名称']);

echo $form->field($model,'sort');
echo $form->field($model,'status')->inline()->radioList(\backend\models\Brand::$paixu);
//echo $form->field($model,'logo')->hiddenInput();
//文件上传
//图片
if($model->logo){
    echo $form->field($model,'imgFile')->fileInput();
    echo \yii\bootstrap\Html::img('@web/'.$model->logo,['style'=>'width:100px;height:50px;']);
}else{
    echo $form->field($model,'imgFile')->fileInput();
}
//echo \yii\bootstrap\Html::fileInput('test', NULL, ['id' => 'test']);
//echo \xj\uploadify\Uploadify::widget([
//    'url' => yii\helpers\Url::to(['s-upload']),
//    'id' => 'test',
//    'csrf' => true,
//    'renderTag' => false,
//    'jsOptions' => [
//        'width' => 120,
//        'height' => 40,
//        'onUploadError' => new JsExpression(<<<EOF
//function(file, errorCode, errorMsg, errorString) {
//    console.log('The file ' + file.name + ' could not be uploaded: ' + errorString + errorCode + errorMsg);
//}
//EOF
//        ),
//        'onUploadSuccess' => new JsExpression(<<<EOF
//function(file, data, response) {
//    data = JSON.parse(data);
//    if (data.error) {
//        console.log(data.msg);
//
//    } else {
//        console.log(data.fileUrl);
//        $("#brand-logo").val(data.fileUrl);
//    }
//}
//EOF
//        ),
//    ]
//]);
echo $form->field($model,'intro')->textarea(['placeholder'=>'简介']);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-warning']);
\yii\bootstrap\ActiveForm::end();

?>