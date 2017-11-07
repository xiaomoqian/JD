<?php

namespace backend\models;

use creocoder\nestedsets\NestedSetsBehavior;
use Yii;
use backend\components\MenuQuery;

/**
 * This is the model class for table "goos".
 *
 * @property integer $id
 * @property string $name
 * @property integer $cate_id
 * @property integer $brand_id
 * @property integer $sn
 * @property string $logo
 * @property integer $status
 * @property integer $sale
 * @property integer $stock
 * @property string $shop_price
 * @property string $stock_price
 */
class Goos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public  $imgFile=[];
    public static function tableName()
    {
        return 'goos';
    }

    /**
     * @inheritdoc
     */
    //定义一个商品状态
    public static $status=['0'=>'商品隐藏','1'=>'显示商品'];
    //是否上架
    public static $sale=['0'=>'商品下架','1'=>'商品上架'];
    public function rules()
    {
        return [
            [['name','cate_id','brand_id','logo','stock','shop_price', 'stock_price'],'required'],
            [['cate_id', 'brand_id',  'status', 'sale', 'stock'], 'integer'],
            [['shop_price', 'stock_price'], 'number'],
            [['name', 'logo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品名称',
            'cate_id' => '商品分类',
            'brand_id' => '商品品牌',
            'sn' => '商品货号',
            'logo' => '商品图片',
            'status' => '商品状态',
            'sale' => '是否上架',
            'stock' => '库存',
            'shop_price' => '上架价格',
            'stock_price' => '进货价格',
            'imgFile'=>'详情图片'
        ];
    }
    //图片显示
    public function getImages(){
        if(substr($this->logo,0,7)=="http://"){
            return $this->logo;
        }else{
            return "@web/".$this->logo;
        }
    }
    //图片删除
    public function getDel($img,$key){
        $qiniu=new Qiniu(
            $config = [
                'accessKey'=>'3QPn6N0S6AZeETy9Pn0gohcabRm7Mkasyf-uc7Yd',
                'secretKey'=>'J68RwhjP6rufO7Wik33GnPVyAtFzsyLLa7x7Vvhx',
                'domain'=>'http://oyw02vzfa.bkt.clouddn.com',
                'bucket'=>$key,
                'area'=>Qiniu::AREA_HUANAN
            ]
        );
        $image=substr($img,-10);
        return $qiniu->delete($image,$key);
    }
}
