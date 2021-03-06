<?=\yii\bootstrap\Html::a("管理员注册",['add'],['class'=>'btn btn-success'])?>
<table class="table" style="text-align: center">
    <tr>
        <th style="text-align: center">用户ID</th>
        <th style="text-align: center">用户账号</th>
        <th style="text-align: center">用户权限</th>
        <th style="text-align: center">用户邮箱</th>
        <th style="text-align: center">用户头像</th>
        <th style="text-align: center">用户注册时间</th>
        <th style="text-align: center">最后登录时间</th>
        <th style="text-align: center">最后登录地址</th>
        <th style="text-align: center">用户操作</th>
    </tr>
    <?php foreach ($admins as $admin):?>
        <tr>
            <td><?=$admin->id?></td>
            <td><?=$admin->username?></td>
            <td>
                <?php
                   $auth=Yii::$app->authManager;
                   $role=$auth->getRolesByUser($admin->id);
                   $s=array_keys($role);
                   $count=count($s);
                   foreach ($s as $k=>$v){
                       if($k==$count-1){
                           echo $v;
                           break;
                       }
                       echo $v.",";
                   }
                ?>
            </td>

            <td><?=$admin->email?></td>
            <td><img src="<?=$admin->img?>" style="width: 100px;height: 50px"></td>
            <td><?=date("Y-m-d H:i:s",$admin->create_at)?></td>
            <td><?=date("Y-m-d H:i:s",$admin->update_at)?></td>
            <td><?=$admin->login_ip?></td>
            <td>
                <?php echo \yii\bootstrap\Html::a("<span class='glyphicon glyphicon-trash'></span>",['del','id'=>$admin->id],['class'=>'btn btn-warning'])?>
                <?php echo \yii\bootstrap\Html::a("<span class='glyphicon glyphicon-pencil'></span>",['edit','id'=>$admin->id],['class'=>'btn btn-warning'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>
<?php
echo \yii\widgets\LinkPager::widget(['pagination' => $page]);
?>