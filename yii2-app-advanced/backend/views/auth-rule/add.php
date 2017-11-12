<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($per,'name')->textInput(["placeholder"=>"角色名称"]);
//echo $form->field($per,'permission')->checkboxList($permissions);
echo $form->field($per,'description')->textarea(['placeholder'=>'角色描述']);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-warning']);
\yii\bootstrap\ActiveForm::end();
