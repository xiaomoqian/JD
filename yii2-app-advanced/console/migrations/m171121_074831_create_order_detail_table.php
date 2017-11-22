<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_detail`.
 */
class m171121_074831_create_order_detail_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order_detail', [
            'id' => $this->primaryKey(),
            'reder_id'=>$this->integer()->comment("订单ID"),
            'goods_id'=>$this->integer()->comment("商品ID"),
            'goods_name'=>$this->string()->comment("商品名称"),
            'logo'=>$this->string()->comment("商品图片"),
            'price'=>$this->decimal()->comment("价格"),
            'amount'=>$this->integer()->comment("商品数量"),
            'total_price'=>$this->decimal()->comment("商品小计")
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('order_detail');
    }
}
