<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_category`.
 */
class m171105_034027_create_goods_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_category', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment("分类名称"),
            'tree' => $this->integer()->notNull()->comment("树"),
            'lft' => $this->integer()->notNull()->comment("左值"),
            'rgt' => $this->integer()->notNull()->comment("右值"),
            'depth' => $this->integer()->notNull()->comment("深度"),
            'parent_id'=>$this->integer()->notNull()->defaultValue(0)->comment("父ID"),
            'intro'=>$this->string()->comment("简介")
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_category');
    }
}
