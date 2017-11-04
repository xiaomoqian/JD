<?=\yii\bootstrap\Html::a("添加分类",['ga'],['class'=>"btn btn-success"])?>
<table class="table" style="text-align: center">
    <tr>
        <th style="text-align: center">分类名称</th>
        <th style="text-align: center">分类排序</th>
        <th style="text-align: center">分类状态</th>
        <th style="text-align: center">辅助分类</th>
        <th style="text-align: center">分类简介</th>
        <th style="text-align: center">分类操作</th>
    </tr>
    <?php foreach($rows as $row):?>
    <tr>
        <td><?=$row->name?></td>
        <td><?=$row->sort?></td>
        <td>
            <?php if($row->status=='1'){
                echo "<div class='glyphicon glyphicon-ok' style='color: #4ab901'></div>";
            }else{
                echo "<div class='glyphicon glyphicon-remove' style='color: #b92c28'></div>";
            }?>
        </td>
        <td>
            <?php if($row->is_htlp=='1'){
                echo "<div class='glyphicon glyphicon-ok' style='color: #4ab901'></div>";
            }else{
                echo "<div class='glyphicon glyphicon-remove' style='color: #b92c28'></div>";
            }?>
        </td>
        <td><?=$row->intro?></td>
        <td>
            <?=\yii\bootstrap\Html::a("<span class='glyphicon glyphicon-trash'></span>",['gdel','id'=>$row->id],['class'=>"btn btn-warning"])?>
            <?php echo \yii\bootstrap\Html::a("<span class='glyphicon glyphicon-pencil'></span>",['gedit','id'=>$row->id],['class'=>'btn btn-info'])?>
        </td>
    </tr>
    <?php endforeach;?>
</table>