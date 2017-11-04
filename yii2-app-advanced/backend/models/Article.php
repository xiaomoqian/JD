<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $name
 * @property integer $article_id
 * @property string $intro
 * @property integer $status
 * @property integer $sort
 * @property integer $create_at
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    //定义状态
    public static $zt=["0"=>'隐藏','1'=>'显示'];
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['article_id', 'status', 'sort', 'create_at'], 'integer'],
            [['name','status','article_id'],'required'],
            [['name'], 'string', 'max' => 50],
            [['intro'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '标题',
            'article_id' => '分类编号',
            'intro' => '简介',
            'status' => '状态',
            'sort' => '排序',
            'create_at' => '上传时间',
        ];
    }
    //注入系统内置时间行为
    public function behaviors()
    {
        return [
            [
                'class'=>TimestampBehavior::className(),
                'attributes' => [
                    # AR类名::EVENT_BEFORE_UPDATE(修改时自动更新时间)=>['要更新的字段']
                    self::EVENT_BEFORE_INSERT=>['create_at','update_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE=>['update_at']
                ],

            ]
        ];
    }
}
