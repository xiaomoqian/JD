<?php
    //显示回收站
    if(isset($yin)){
?>
<div align="center"><h1>品牌回收站</h1></div>
    <div style="float: right">
        <?php echo \yii\bootstrap\Html::a("一键回收",['reco'],['class'=>'btn btn-primary'])?>
    </div>
<table class="table table-hover" style="text-align: center">
    <tr>
        <th style="text-align: center">ID</th>
        <th style="text-align: center">名称</th>
        <th style="text-align: center">图片</th>
        <th style="text-align: center">排序</th>
        <th style="text-align: center">简介</th>
        <th style="text-align: center">操作</th>
    </tr>
    <?php

        foreach ($rows as $row):
        ?>
    <tr>
        <td><?=$row->id?></td>
        <td><?=$row->name?></td>
        <td><?=\yii\bootstrap\Html::img($row->logo,['height'=>'50px'])?></td>
        <td><?=$row->sort?></td>
        <td><?=$row->intro?></td>
        <td>
            <?php echo \yii\bootstrap\Html::a("还原",['status','id'=>$row->id],['class'=>'btn btn-success'])?>
            <?php echo \yii\bootstrap\Html::a("删除",['del','id'=>$row->id],['class'=>'btn btn-warning'])?>
        </td>
    </tr>
    <?php endforeach;?>
</table>

        <div align="right">
            <?php
            //分页
            echo \yii\widgets\LinkPager::widget(['pagination'=>$page]);
            ?>
        </div>

<!--       回收站结束 -->
<!--        品牌显示-->
    <?php }else{ //显示品牌?>
<div align="center"><h1>品牌列表</h1></div>
    <?php echo \yii\bootstrap\Html::a("添加品牌",['add'],['class'=>'btn btn-primary'])." "?>
    <div style="float: right;">
    <?php echo \yii\bootstrap\Html::a("一键删除",['onekey'],['class'=>'btn btn-primary'])." "?>
    </div>
<table class="table table-hover" style="text-align: center">
    <tr>
        <th style="text-align: center">ID</th>
        <th style="text-align: center">名称</th>
        <th style="text-align: center">图片</th>
        <th style="text-align: center">排序</th>
        <th style="text-align: center">状态</th>
        <th style="text-align: center">简介</th>
        <th style="text-align: center">操作</th>
    </tr>
    <?php
       foreach ($rows as $row):
    ?>
    <tr>
        <td><?=$row->id?></td>
        <td><?=$row->name?></td>
        <td><?=\yii\bootstrap\Html::img($row->images,['height'=>'50px'])?></td>
        <td><?=$row->sort?></td>
        <td><?php if($row->status=='1'){
            echo "<div class='glyphicon glyphicon-ok' style='color: #b92c28'></div>";
            }else{
            echo "<div class='glyphicon glyphicon-remove' style='color: #b92c28'></div>";
            }?></td>
        <td><?=$row->intro?></td>
        <td>
            <?php echo \yii\bootstrap\Html::a("<span class='glyphicon glyphicon-trash'></span>",['shanchu','id'=>$row->id],['class'=>'btn btn-warning'])?>
            <?php echo \yii\bootstrap\Html::a("<span class='glyphicon glyphicon-pencil'></span>",['edit','id'=>$row->id],['class'=>'btn btn-info'])?>
        </td>
    </tr>
    <?php   endforeach;?>
</table>
        <div align="right">
            <?php
            //分页
            echo \yii\widgets\LinkPager::widget(['pagination'=>$page]);
            ?>
        </div>
<?php }?>
<!--品牌显示结束-->