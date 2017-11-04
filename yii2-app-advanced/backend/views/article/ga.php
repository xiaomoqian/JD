<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name')->textInput(['placeholder'=>'分类名称']);
echo $form->field($model,"sort")->textInput(['placeholder'=>'分类排序']);
echo $form->field($model,'status')->inline()->radioList(\backend\models\ArticleCateGory::$zt);
echo $form->field($model,'is_htlp')->inline()->radioList(\backend\models\ArticleCateGory::$ga);
echo $form->field($model,"intro")->textarea(['placeholder'=>'分类简介']);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>"btn btn-success"]);
\yii\bootstrap\ActiveForm::end();
?>