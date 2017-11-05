<?php
/**
 * Created by PhpStorm.
 * User: SAMSUNG
 * Date: 2017/11/5
 * Time: 14:04
 */

namespace backend\components;


use creocoder\nestedsets\NestedSetsQueryBehavior;
use yii\db\ActiveQuery;

class MenuQuery extends ActiveQuery
{
    public function behaviors() {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }
}