<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goos`.
 */
class m171107_034138_create_goos_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goos', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->comment("商品名称"),
            'cate_id'=>$this->smallInteger()->comment("分类ID"),
            'brand_id'=>$this->smallInteger()->comment("品牌ID"),
            'sn'=>$this->smallInteger()->comment("商品货号"),
            'logo'=>$this->string()->comment("商品图片"),
            'status'=>$this->smallInteger()->comment("商品状态"),
            'sale'=>$this->smallInteger()->comment("是否上架"),
            'stock'=>$this->smallInteger()->comment("库存"),
            'shop_price'=>$this->decimal(10,2)->comment("上架价格"),
            'stock_price'=>$this->decimal(10,2)->comment("进货价格")
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goos');
    }
}
