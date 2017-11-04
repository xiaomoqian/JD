<div align="center">
<table class="table">
    <tr>
        <th>文章标题:<?=\backend\models\Article::findOne($content->detail_id)->name?></th>
    </tr>
    <tr>
        <td>
          <?php
                $form=\yii\bootstrap\ActiveForm::begin();
                echo $form->field($content,'detail_id')->hiddenInput();
                echo $form->field($content,'content')->textarea();
                echo \yii\bootstrap\Html::submitButton('提交',['class'=>"btn btn-success"]);
                \yii\bootstrap\ActiveForm::end();
          ?>
        </td>
    </tr>
</table>

</div>
