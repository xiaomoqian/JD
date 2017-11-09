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
   public $status;
   public static $s=[''=>'选择状态','0'=>'隐藏','1'=>'显示'];
   public function rules(){
       return [
           [['min','max'],'number','message' => ''],
           [['key','status'],'safe']
       ];
   }
}
