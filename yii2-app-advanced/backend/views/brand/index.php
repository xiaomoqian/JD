
<div align="center"><h1>品牌列表</h1></div>
<?php echo \yii\bootstrap\Html::a("添加品牌",['add'],['class'=>'btn btn-primary'])?>
<table class="table table-hover" style="text-align: center">
    <tr>
        <th style="text-align: center">ID</th>
        <th style="text-align: center">名称</th>
        <th style="text-align: center">图片</th>
        <th style="text-align: center">状态</th>
        <th style="text-align: center">排序</th>
        <th style="text-align: center">简介</th>
        <th style="text-align: center">操作</th>
    <?php foreach ($rows as $row):?>
    <tr>
        <td><?=$row->id?></td>
        <td><?=$row->name?></td>
        <td><img src="/<?=$row->logo?>" style="width: 100px;height: 50px;"/></td>
        <td><?=$row->status?></td>
        <td><?=$row->sort?></td>
        <td><?=$row->intro?></td>
        <td>
            <?php echo \yii\bootstrap\Html::a("<span class='glyphicon glyphicon-trash'></span>",['del','id'=>$row->id],['class'=>'btn btn-warning'])?>
            <?php echo \yii\bootstrap\Html::a("<span class='glyphicon glyphicon-pencil'></span>",['edit','id'=>$row->id],['class'=>'btn btn-info'])?>
        </td>
    </tr>
    <?php endforeach;?>
</table>