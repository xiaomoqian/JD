<?php
use yii\web\JsExpression;
$form=\yii\bootstrap\ActiveForm::begin();
if(isset($status)){
    echo "<div align='center'>";
    echo $form->field($status,'status')->radioList(\backend\models\Brand::$paixu);
    echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-warning']);
    echo "</div>";
}else{

echo $form->field($model,'name')->textInput(['placeholder'=>'名称']);
echo $form->field($model,'sort')->textInput(['placeholder'=>'排序']);
echo $form->field($model,'status')->inline()->radioList(\backend\models\Brand::$paixu);
//文件上传
echo $form->field($model,'logo')->widget('manks\FileInput',[]);
echo $form->field($model,'intro')->textarea(['placeholder'=>'简介']);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-warning']);
}
\yii\bootstrap\ActiveForm::end();

?>