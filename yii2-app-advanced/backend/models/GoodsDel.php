<?php
/**
 * Created by PhpStorm.
 * User: SAMSUNG
 * Date: 2017/11/5
 * Time: 19:41
 */

namespace backend\models;


use yii\db\ActiveRecord;

class GoodsDel extends ActiveRecord
{
    public static function tableName()
    {
        return 'goods_category';
    }
}