<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'username')->textInput(['placeholder'=>'用户账号']);
echo $form->field($model,'password')->passwordInput(['placeholder'=>'用户密码']);
echo $form->field($model,"role")->checkboxList($role);
echo $form->field($model,'email')->textInput(['placeholder'=>'email@qq.com']);

echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-warning']);
\yii\bootstrap\ActiveForm::end();
?>