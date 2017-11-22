<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $user_name
 * @property string $province_name
 * @property string $city_name
 * @property string $area_name
 * @property string $detail_address
 * @property string $tel
 * @property integer $delivery_id
 * @property string $delivery_name
 * @property string $delivery_price
 * @property integer $pay_id
 * @property string $pay_name
 * @property string $price
 * @property integer $status
 * @property string $trade_no
 * @property string $create_at
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'delivery_id', 'pay_id', 'status'], 'integer'],
            [['trade_no', 'province_name', 'city_name', 'area_name', 'detail_address', 'delivery_name', 'delivery_price', 'pay_name','user_id', 'delivery_id', 'pay_id', 'status'],'required'],
            [['price'], 'number'],
        ];
    }
    /*
     * 订单状态:0取消,1待付款，2待发货，3待收货，4完成
     */
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'user_name' => '收货人',
            'province_name' => '省份',
            'city_name' => '城市',
            'area_name' => '区县',
            'detail_address' => '详细地址',
            'tel' => '联系电话',
            'delivery_id' => '配送方式ID',
            'delivery_name' => '配送方式名称',
            'delivery_price' => '运费',
            'pay_id' => '支付方式ID',
            'pay_name' => '支付方式名称',
            'price' => '商品金额',
            'status' => '订单状态',
            'trade_no' => '第三方交易号',
            'create_at' => '订单创建时间',
        ];
    }
    //自动注入时间行为
    public function behaviors()
    {
        return [
            [
            'class'=>TimestampBehavior::className(),
            'attributes' => [
                self::EVENT_BEFORE_INSERT=>['create_at'],
            ]
            ]
        ];
    }
}
