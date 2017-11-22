<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order_detail".
 *
 * @property integer $id
 * @property integer $reder_id
 * @property integer $goods_id
 * @property string $goods_name
 * @property string $logo
 * @property string $price
 * @property integer $amount
 * @property string $total_price
 */
class OrderDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reder_id', 'goods_id', 'amount'], 'integer'],
            [['price', 'total_price'], 'number'],
            [['goods_name', 'logo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reder_id' => '订单ID',
            'goods_id' => '商品ID',
            'goods_name' => '商品名称',
            'logo' => '商品图片',
            'price' => '价格',
            'amount' => '商品数量',
            'total_price' => '商品小计',
        ];
    }
}
