<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($per,'name')->textInput(["placeholder"=>"权限名称"]);
echo $form->field($per,'description')->textarea(['placeholder'=>'权限描述']);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-warning']);
\yii\bootstrap\ActiveForm::end();
