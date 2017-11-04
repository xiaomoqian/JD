<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_category`.
 */
class m171104_084057_create_article_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_category', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(50)->comment("名称"),
            'intro'=>$this->string(100)->comment("简介"),
            'status'=>$this->smallInteger()->comment("状态"),
            'sort'=>$this->smallInteger()->defaultValue(100)->comment("排序"),
            'is_htlp'=>$this->smallInteger()->notNull()->comment("是否是辅助相关的分类")
            ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_category');
    }
}
