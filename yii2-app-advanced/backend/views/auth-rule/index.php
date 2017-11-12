<?=\yii\bootstrap\Html::a("添加角色",['rbac/role/create'],['class'=>'btn btn-success'])?>
<table class="table table-hover table-striped table-bordered" style="text-align: center">
    <tr>
        <th style="text-align: center">角色名称</th>
        <th style="text-align: center">角色描述</th>
        <th style="text-align: center">角色操作</th>
    </tr>
    <?php foreach ($pers as $per):?>
    <tr>

        <td><?=$per->name?></td>
        <td><?=$per->description?></td>
        <td>
            <?=\yii\bootstrap\Html::a("<script class='glyphicon glyphicon-trash'></script>",['del','name'=>$per->name],['class'=>'btn btn-danger'])?>
            <?php echo \yii\bootstrap\Html::a("修改名称",['rbac/role/update','id'=>$per->name],['class'=>'btn btn-info'])?>
            <?php echo \yii\bootstrap\Html::a("修改权限",['rbac/role/view','id'=>$per->name],['class'=>'btn btn-info'])?>
        </td>
    </tr>
    <?php endforeach;?>
</table>