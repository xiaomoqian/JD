<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name')->textInput(['placeholder'=>'文章名称']);
echo $form->field($model,'article_id')->dropDownList($arrgory);
echo $form->field($model,"sort")->textInput(['placeholder'=>'文章排序']);
echo $form->field($model,'status')->inline()->radioList(\backend\models\Article::$zt);
echo $form->field($model,"intro")->textarea(['placeholder'=>'文章简介']);
if (isset($detail)){
//echo $form->field($detail,'content')->textarea(['placeholder'=>'文章内容']);
    echo $form->field($detail, 'content')->widget(\yuncms\ueditor\UEditor::className(),[]);
}
echo \yii\bootstrap\Html::submitButton('提交',['class'=>"btn btn-success"]);
\yii\bootstrap\ActiveForm::end();
?>