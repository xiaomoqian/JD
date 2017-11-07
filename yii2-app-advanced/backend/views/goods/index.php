<a href="add" class="btn btn-success">添加商品</a>
<table class="table" style="text-align: center">
    <tr>
        <th style="text-align: center">商品ID</th>
        <th style="text-align: center">商品名称</th>
        <th style="text-align: center">商品分类</th>
        <th style="text-align: center">商品品牌</th>
        <th style="text-align: center">商品货号</th>
        <th style="text-align: center">商品图片</th>
        <th style="text-align: center">商品状态</th>
        <th style="text-align: center">是否上架</th>
        <th style="text-align: center">商品库存</th>
        <th style="text-align: center">进货价格</th>
        <th style="text-align: center">上架价格</th>
        <th style="text-align: center">商品操作</th>
    </tr>
    <?php foreach ($goods as $good):?>
     <tr>
         <td><?=$good->id?></td>
         <td><?=$good->name?></td>
         <td><?php echo \backend\models\GoodsCategory::findOne($good->cate_id)->name;?></td>
         <td><?=\backend\models\Brand::findOne($good->brand_id)->name?></td>
         <td><?=$good->sn?></td>
         <td><?=\yii\bootstrap\Html::img($good->images,['height'=>'50px'])?></td>
         <td>
             <?php
                  if($good->status=="1"){
                      echo "<div class='glyphicon glyphicon-ok' style='color: #6fb90d'></div>";
                  }else{
                      echo "<div class='glyphicon glyphicon-remove' style='color: #b92c28'></div>";
                  }
             ?>
         </td>
         <td>
             <?php
             if($good->sale=="1"){
                 echo "<div class='' style='color: #69b915'>上架中</div>";
             }else{
                 echo "<div class='' style='color: #b92c28'>也下架</div>";
             }
             ?>
         </td>
         <td><?=$good->stock?></td>
         <td><?=$good->stock_price?></td>
         <td><?=$good->shop_price?></td>
         <td>
             <?php echo \yii\bootstrap\Html::a("<span class='glyphicon glyphicon-trash'></span>",['del','id'=>$good->id],['class'=>'btn btn-warning'])?>
             <?php echo \yii\bootstrap\Html::a("<span class='glyphicon glyphicon-pencil'></span>",['edit','id'=>$good->id],['class'=>'btn btn-info'])?>
             <?php echo \yii\bootstrap\Html::a("<span class='glyphicon glyphicon-eye-open'></span>",['see','id'=>$good->id],['class'=>'btn btn-success'])?>
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
