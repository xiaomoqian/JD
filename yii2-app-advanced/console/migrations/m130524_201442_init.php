<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique()->comment("用户名"),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull()->comment("用户密码"),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique()->comment("邮箱"),
            'status' => $this->smallInteger()->notNull()->defaultValue(10)->comment("状态"),
            'created_at' => $this->integer()->notNull()->comment("创建时间"),
            'updated_at' => $this->integer()->notNull()->comment("更新时间"),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
