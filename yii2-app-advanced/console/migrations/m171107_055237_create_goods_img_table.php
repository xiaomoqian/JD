<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_img`.
 */
class m171107_055237_create_goods_img_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_img', [
            'id' => $this->primaryKey(),
            'goobs_id'=>$this->smallInteger()->comment("商品ID"),
            'name'=>$this->string()->comment("相册"),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_img');

    }
}
