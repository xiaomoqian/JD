<?php
/**
 * Created by PhpStorm.
 * User: SAMSUNG
 * Date: 2017/11/17
 * Time: 19:40
 */

namespace frontend\widgets;


use backend\models\GoodsCategory;
use yii\base\Widget;
use yii\helpers\Html;

class GoodsCateWidget extends Widget
{
    //是否展开商品
    public $isIndex=false;
    public function run(){
        $cat1=  $this->isIndex?'':'cat1';
        $none = $this->isIndex?'':'none';
        $cateId="goodsCategory".$this->isIndex;
        //得到缓存
        $html=\Yii::$app->cache->get($cateId);
        if ($html!=false){
            return $html;
        }
       $html='';
       //获取一节分类
    $categories=GoodsCategory::find()->where(['parent_id'=>0])->all();
    foreach ($categories as $k1=>$v1){
        $html .= '<div class="cat '.($k1==0?'item1':'').'">';
        $html .= '<h3>'.Html::a($v1->name,['index/list','id'=>$v1->id]).'<b></b></h3>';
        $html .= '<div class="cat_detail">';
        //获取二级分类
        foreach ($v1->children as $v2){
            $html .= '<dl class="dl_1st"><dt>'.Html::a($v2->name,['index/list','id'=>$v2->id]).'</dt><dd>';
            //获取三级分类
            foreach ($v2->children as $v3){
                $html .= Html::a($v3->name,['index/list','id'=>$v3->id]);
            }
            $html .= '</dd></dl>';
        }
        $html .= '</div></div>';
    }
     $m= <<<EOF
                 <div class="category fl {$cat1}"> <!-- 非首页，需要添加cat1类 -->
            <div class="cat_hd">  <!-- 注意，首页在此div上只需要添加cat_hd类，非首页，默认收缩分类时添加上off类，鼠标滑过时展开菜单则将off类换成on类 -->
                <h2>全部商品分类</h2>
                <em></em>
            </div>
            <div class="cat_bd {$none}">
                 {$html}
        </div>
    </div>
EOF;
        //存储缓存
        \Yii::$app->cache->set($cateId,$m);
 return $m;
   }
}