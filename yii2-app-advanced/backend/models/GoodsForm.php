<?php
/**
 * Created by PhpStorm.
 * User: SAMSUNG
 * Date: 2017/11/8
 * Time: 18:18
 */

namespace backend\models;


use yii\base\Model;

class GoodsForm extends Model
{
   public $key;
   public $min;
   public $max;
   public function rules(){
       return [
           [['min','max'],'number'],
           [['key'],'safe']
       ];
   }
}