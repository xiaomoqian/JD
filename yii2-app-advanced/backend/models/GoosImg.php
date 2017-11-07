<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "goods_img".
 *
 * @property integer $id
 * @property integer $goobs_id
 * @property string $name
 */
class GoosImg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'goods_img';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goobs_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goobs_id' => '商品ID',
            'img' => '相册',
        ];
    }
}
