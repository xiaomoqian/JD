<?=\yii\bootstrap\Html::a("管理员注册",['add'],['class'=>'btn btn-success'])?>
<table class="table" style="text-align: center">
    <tr>
        <th style="text-align: center">用户ID</th>
        <th style="text-align: center">用户账号</th>
        <th style="text-align: center">用户密码</th>
        <th style="text-align: center">用户邮箱</th>
        <th style="text-align: center">登录令牌</th>
        <th style="text-align: center">用户注册时间</th>
        <th style="text-align: center">最后登录时间</th>
        <th style="text-align: center">最后登录地址</th>
        <th style="text-align: center">用户操作</th>
    </tr>
    <?php foreach ($admins as $admin):?>
        <tr>
            <td><?=$admin->id?></td>
            <td><?=$admin->username?></td>
            <td><?=substr($admin->password,0,20)?>....</td>
            <td><?=$admin->email?></td>
            <td><?=substr($admin->token,0,20)?>....</td>
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