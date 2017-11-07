
<?php if(isset($edit)){?>
     <table class="table" style="text-align: center">
         <tr><td>商品名称:<?=backend\models\Goos::findOne($edit->goods_id)->name?></td></tr>
         <tr>
            <td>
                <?php
                   $form=\yii\bootstrap\ActiveForm::begin();
                echo $form->field($edit, 'details')->widget(\yuncms\ueditor\UEditor::className(),[]);
                   echo \yii\bootstrap\Html::submitButton('修改',['class'=>'btn btn-warning']);
                \yii\bootstrap\ActiveForm::end();
                ?>
            </td>
        </tr>
   </table>

    <?php }else{?>

 <div align="center"><h1>商品详情</h1></div>
 <table class="table" style="text-align: center">
        <tr>
            <th style="text-align: center">商品名称</th>
            <th style="text-align: center">商品介绍</th>
            <th style="text-align: center">内容操作</th>
        </tr>
    <tr>
        <td><?=backend\models\Goos::findOne($details->goods_id)->name?></td>
    <td><?=$details->details?></td>
        <td>
            <?php echo \yii\bootstrap\Html::a("<span class='glyphicon glyphicon-pencil'></span>",['details-edit','id'=>$details->goods_id],['class'=>'btn btn-info'])?>
            <?php echo \yii\bootstrap\Html::a("<span class='glyphicon glyphicon-share-alt'></span>",['index'],['class'=>'btn btn-info'])?>

        </td>
    </tr>
    <?php }?>
</table>