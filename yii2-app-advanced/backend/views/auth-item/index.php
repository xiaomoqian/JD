<?=\yii\bootstrap\Html::a("添加权限",['rbac/permission/create'],['class'=>'btn btn-success'])?>
<table class="table table-hover table-striped table-bordered" style="text-align: center">
    <tr>
        <th style="text-align: center">权限名称</th>
        <th style="text-align: center">权限描述</th>
        <th style="text-align: center">权限操作</th>
    </tr>
    <?php foreach ($pers as $per):?>
    <tr>

        <td> <?php      echo strpos($per->name,"/")?"------&nbsp":" ";?><?=$per->name?></td>
        <td><?=$per->description?></td>
        <td>
            <?=\yii\bootstrap\Html::a("<script class='glyphicon glyphicon-trash'></script>",['del','name'=>$per->name],['class'=>'btn btn-danger'])?>
            <?php echo \yii\bootstrap\Html::a("<span class='glyphicon glyphicon-pencil'></span>",['edit','name'=>$per->name],['class'=>'btn btn-info'])?>
        </td>
    </tr>
    <?php endforeach;?>
</table>
<div align="right">
<?php
        echo \yii\widgets\LinkPager::widget(['pagination' => $page]);
?>
</div>
