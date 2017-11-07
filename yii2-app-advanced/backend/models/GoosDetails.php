<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "goods_details".
 *
 * @property integer $id
 * @property integer $goods_id
 * @property string $details
 */
class GoosDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id'], 'integer'],
            [['details'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_id' => '商品ID',
            'details' => '商品详情',
        ];
    }
}
