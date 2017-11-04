<div align="center"><h1>文章内容</h1></div>
<table class="table" style="text-align: center">
    <tr>
        <th style="text-align: center">文章名称</th>
        <th style="text-align: center">文章内容</th>
        <th style="text-align: center">内容操作</th>
    </tr>
    <tr>
        <td><?=backend\models\Article::findOne($details->detail_id)->name?></td>
        <td><?=$details->content?></td>
        <td>
            <?php echo \yii\bootstrap\Html::a("<span class='glyphicon glyphicon-pencil'></span>",['content','id'=>$details->detail_id],['class'=>'btn btn-info'])?>
            <?php echo \yii\bootstrap\Html::a("<span class='glyphicon glyphicon-share-alt'></span>",['index'],['class'=>'btn btn-info'])?>

        </td>
    </tr>
</table>