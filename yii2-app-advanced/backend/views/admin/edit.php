<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'username')->textInput(['placeholder'=>'用户账号']);
echo $form->field($model,'password')->passwordInput(['placeholder'=>'输入新密码']);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-warning']);
\yii\bootstrap\ActiveForm::end();
?>