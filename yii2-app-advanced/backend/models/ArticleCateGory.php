<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property integer $status
 * @property integer $sort
 * @property integer $is_htlp
 */
class ArticleCateGory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    //定义状态
    public static $zt=["0"=>'隐藏','1'=>'显示'];
    public static $ga=["0"=>'不是','1'=>'是'];
    public static function tableName()
    {
        return 'article_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'sort', 'is_htlp'], 'integer'],
            [['is_htlp'], 'required'],
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
            'name' => '名称',
            'intro' => '简介',
            'status' => '状态',
            'sort' => '排序',
            'is_htlp' => '辅助相分类',
        ];
    }
}
