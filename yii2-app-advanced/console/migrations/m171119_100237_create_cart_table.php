<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cart`.
 */
class m171119_100237_create_cart_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cart', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer()->comment("用户ID"),
            'goods_id'=>$this->integer()->comment("商品ID"),
            'num'=>$this->integer()->comment('购买数量'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cart');
    }
}
