<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m171104_031334_create_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(50)->comment("名称"),
            'article_id'=>$this->smallInteger()->comment("分类"),
            'intro'=>$this->string(100)->comment("简介"),
            'status'=>$this->smallInteger()->comment("状态"),
            'sort'=>$this->smallInteger()->defaultValue(100)->comment("排序"),
            'create_at'=>$this->integer()->comment("上传时间")
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article');
    }
}
