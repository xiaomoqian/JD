<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_detail`.
 */
class m171104_032129_create_article_detail_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_detail', [
            'id' => $this->primaryKey(),
            'content'=>$this->text()->comment("文章内容"),
            'detail_id'=>$this->smallInteger()->comment("所属文章分类")
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_detail');
    }
}
