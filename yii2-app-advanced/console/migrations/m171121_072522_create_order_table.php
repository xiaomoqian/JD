<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m171121_072522_create_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer()->comment("用户ID"),
            'user_name'=>$this->string()->comment('收货人'),
            'province_name'=>$this->string()->comment('省份'),
            'city_name'=>$this->string()->comment('城市'),
            'area_name'=>$this->string()->comment('区县'),
            'detail_address'=>$this->string()->comment('详细地址'),
            'tel'=>$this->char()->comment('联系电话'),
            'delivery_id'=>$this->integer()->comment('配送方式ID'),
            'delivery_name'=>$this->string()->comment('配送方式名称'),
            'delivery_price'=>$this->string()->comment('运费'),
            'pay_id'=>$this->integer()->comment('支付方式ID'),
            'pay_name'=>$this->string()->comment('支付方式名称'),
            'price'=>$this->decimal()->comment('商品金额'),
            'status'=>$this->integer()->comment('订单状态'),
            'trade_no'=>$this->char()->comment('第三方交易号'),
            'create_at'=>$this->string()->comment('订单创建时间')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('order');
    }
}
