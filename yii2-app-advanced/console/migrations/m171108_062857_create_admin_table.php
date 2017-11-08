<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m171108_062857_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'username'=>$this->string()->notNull()->defaultValue("游客")->comment("用户账号"),
            'password'=>$this->string()->notNull()->comment("用户密码"),
            'email'=>$this->string()->notNull()->comment("用户邮箱"),
            'token'=>$this->string()->comment("自动登录"),
            'create_at'=>$this->string()->comment("注册时间"),
            'update_at'=>$this->string()->comment("最后登录时间"),
            'login_ip'=>$this->string()->comment("最后登录地点")
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin');
    }
}
