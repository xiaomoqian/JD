# 项目介绍
## 项目描述简介
类似京西商城的B2C商城 (C2C B2B O2O P2P ERP进销存 CRM客户关系管理)
## 主要功能模块
系统包括：
后台：品牌管理、商品分类管理、商品管理、订单管理、系统管理和会员管理六个功能模块。
前台：首页、商品展示、商品购买、订单管理、在线支付等。

## 项目人员组成
<table border="1">
<tr>
  <th>职位</th>
  <th>人数</th>
</tr>
<tr>
  <td>组长</td><td>1人</td>   
</tr>
<tr>
  <td>开发人员</td><td>3人</td>   
</tr>
<tr>
  <td>前段开发人员</td><td>1人</td>   
</tr>
<tr>
  <td>测试人员</td><td>1人</td>   
</tr>
</table>

## 1.品牌功能模块
### 需求
品牌管理功能涉及品牌的列表展示、品牌添加、修改、删除功能。
品牌需要保存缩略图和简介。
品牌删除使用逻辑删除。
### 流程

### 设计要点（数据库和页面交互）

### 要点难点及解决方案
1.	删除使用逻辑删除,只改变status属性,不删除记录
2.	使用uploadify插件,提升用户体验
3.	使用composer下载和安装uploadify
4.	composer安装插件报错,解决办法:
- composer global require "fxp/composer-asset-plugin:^1.2.0"

## 2.文章功能模块
### 需求
文章管理功能涉及品牌的列表展示、文章分类、文章内容分表、文章添加、修改、删除功能

### 流程

### 设计要点（数据库和页面交互）

### 要点难点及解决方案
1. 多模型一起存储
2. 使用插件，提示用户体验
3. 使用composer下载安装gethup文件上传插件

## 3.商品分类
### 需求
商品管理功能涉及商品的列表展示、商品分类、商品添加、修改、删除功能
### 流程
设计数据库、创建模型、创建控制器、创建视图、填写代码、调试bug
### 设计要点
通过全球基佬聚集地(github)下载插件
### 要点难点及解决方案
1. 列表用下拉框层级显示
2. 使用插件，提高用户体验
3. 在老文的网址上下载ztree插件

## 3.商品管理

### 需求
商品管理模块涉及商品的列表展示、商品分类、商品添加、修改、删除功能，
数据连表查询，增加，删除与修改

```php
        createTable('goos', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->comment("商品名称"),
            'cate_id'=>$this->smallInteger()->comment("分类ID"),
            'brand_id'=>$this->smallInteger()->comment("品牌ID"),
            'sn'=>$this->smallInteger()->comment("商品货号"),
            'logo'=>$this->string()->comment("商品图片"),
            'status'=>$this->smallInteger()->comment("商品状态"),
            'sale'=>$this->smallInteger()->comment("是否上架"),
            'stock'=>$this->smallInteger()->comment("库存"),
            'shop_price'=>$this->decimal(10,2)->comment("上架价格"),
            'stock_price'=>$this->decimal(10,2)->comment("进货价格")
        ]);
        
        createTable('goods_details', [
                    'id' => $this->primaryKey(),
                    'goods_id'=>$this->smallInteger()->comment("商品ID"),
                    'details'=>$this->text()->comment("商品详情"),
                ]);
                
          createTable('goods_img', [
                      'id' => $this->primaryKey(),
                      'goobs_id'=>$this->smallInteger()->comment("商品ID"),
                      'name'=>$this->string()->comment("相册"),
                  ]);
            createTable('goods_day_count', [
                        'id' => $this->primaryKey(),
                        'day'=>$this->date()->comment("日期"),
                        'count'=>$this->string()->comment("总数")
                    ]);
```
### 流程
设计数据库、创建模型、创建控制器、创建视图、填写代码、调试bug
### 设计要点
通过全球基佬聚集地(github)下载插件，下载富文本插件
### 要点难点及解决方案
1. 多文件回显与修改后删除七牛云的图片与数据库的图片
2. 使用插件，提高用户体验
3. 表与表之间的关系
4.  统计每天创建商品次数，到一个新的数据表中
5. 删除连表数据时候，如果数据库没有数据会出现问题
```php
 $del=Goos::findOne($id);
        $img=GoosImg::find()->where(['goobs_id'=>$id])->all();
        $details=GoosDetails::findOne(['goods_id'=>$id]);
         if($del){
             if($img){
                 foreach ($img as $k){
                     $k->delete();
                 }
             }
             if($details){
                 $details->delete();
             }
             $del->delete();
             \Yii::$app->session->setFlash('success','删除成功');
             return $this->redirect(['index']);
```
