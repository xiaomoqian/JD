<?php

namespace backend\models;

use flyok666\qiniu\Qiniu;
use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property string $logo
 * @property integer $sort
 * @property integer $status
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static $paixu=['0'=>'隐藏','1'=>'显示'];
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','sort','intro','logo'],'required'],
            [['sort', 'status'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['intro'], 'string', 'max' => 255],
            [['logo'], 'safe'],
//            [['imgFile'],'file','skipOnEmpty' => true,'extensions' => ['jpg','png','gif']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'intro' => '简介',
            'imgFile' => '图片',
            'sort' => '排序',
            'status' => '状态',
            'logo'=>'图片上传'
        ];
    }
    public function getImages(){
       if(substr($this->logo,0,7)=="http://"){
           return $this->logo;
       }else{
           return "@web/".$this->logo;
       }
    }
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
//        exit($img);
       return $qiniu->delete($image,$key);
    }
}
