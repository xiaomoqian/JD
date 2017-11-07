<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_details`.
 */
class m171107_035658_create_goods_details_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_details', [
            'id' => $this->primaryKey(),
            'goods_id'=>$this->smallInteger()->comment("商品ID"),
            'details'=>$this->text()->comment("商品详情"),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_details');
    }
}
