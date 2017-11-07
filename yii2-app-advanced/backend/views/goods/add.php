<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,"name")->textInput(['placeholder'=>"商品名称"]);
echo $form->field($model,'sn')->textInput(['placeholder'=>'商品货号']);
echo $form->field($model,'brand_id')->dropDownList($arrbrand);

//商品分类
echo $form->field($model,'cate_id')->hiddenInput();

echo  \liyuze\ztree\ZTree::widget([
    'setting' => '{
          callback:{
              onClick:function(event, treeId, treeNode){
                 $("#goos-cate_id").val(treeNode.id);
              }
          },
			data: {
				simpleData: {
					enable: true,
                  idKey: "id",
                  pIdKey: "parent_id",
                  rootPId: 0
				}
			}
		}',
    'nodes' => $cates,
]);
echo $form->field($model,'logo')->widget('manks\FileInput',[]);

echo $form->field($model,'status')->inline()->radioList(\backend\models\Goos::$status);
echo $form->field($model,'sale')->inline()->radioList(\backend\models\Goos::$sale);

echo $form->field($model,'stock')->textInput(['placeholder'=>'商品库存']);
echo $form->field($model,'shop_price')->textInput(['placeholder'=>'上架价格']);
echo $form->field($model,'stock_price')->textInput(['placeholder'=>'进货价格']);

//商品多文件上传
echo $form->field($model,'imgFile')->widget('manks\FileInput',[
    'clientOptions' => [
        'pick' => [
            'multiple' => true,
        ],
        // 'server' => Url::to('upload/u2'),
        // 'accept' => [
        // 	'extensions' => 'png',
        // ],
    ],
]);
//很陋的富文本
//echo $form->field($detail, 'details')->widget(\kriss\wangEditor\WangEditorWidget::className());
//完美富文本
echo $form->field($detail, 'details')->widget(\yuncms\ueditor\UEditor::className(),[]);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-warning']);
\yii\bootstrap\ActiveForm::end();

$js=<<<EOF
var treeObj = $.fn.zTree.getZTreeObj("w1");
    treeObj.expandAll(true);
    var node = treeObj.getNodeByParam("id", "{$model->cate_id}", null);
    treeObj.selectNode(node);
EOF;


$this->registerJs($js);
?>