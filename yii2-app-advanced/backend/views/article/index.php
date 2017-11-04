<div align="center"><h1>文章列表</h1></div>
<table class="table" style="text-align: center">
    <tr>
        <th style="text-align: center">文章名称</th>
        <th style="text-align: center">文章分类</th>
        <th style="text-align: center">文章排序</th>
        <th style="text-align: center">文章状态</th>
        <th style="text-align: center">文章简介</th>
        <th style="text-align: center">录入时间</th>
        <th style="text-align: center">更新时间</th>
        <th style="text-align: center">文章操作</th>
    </tr>
    <?php foreach($rows as $row):?>
    <tr>
        <td><?=$row->name?></td>
        <td><?=backend\models\ArticleCateGory::findOne($row->article_id)->name?></td>

        <td><?=$row->sort?></td>
        <td>
            <?php if($row->status=='1'){
                echo "<div class='glyphicon glyphicon-ok' style='color: #4ab901'></div>";
            }else{
                echo "<div class='glyphicon glyphicon-remove' style='color: #b92c28'></div>";
            }?>
        </td>
        <td><?=$row->intro?></td>
        <td><?=date("Y-m-d H:i:s",$row->create_at)?></td>
        <td><?=date("Y-m-d H:i:s",$row->update_at)?></td>
        <td>
            <?=\yii\bootstrap\Html::a("<span class='glyphicon glyphicon-trash'></span>",['del','id'=>$row->id],['class'=>"btn btn-warning"])?>
            <?php echo \yii\bootstrap\Html::a("<span class='glyphicon glyphicon-pencil'></span>",['edit','id'=>$row->id],['class'=>'btn btn-info'])?>
            <?php echo \yii\bootstrap\Html::a("<span class='glyphicon glyphicon-book'></span>",['detail','id'=>$row->id],['class'=>'btn btn-info'])?>
        </td>
    </tr>
    <?php endforeach;?>
</table>