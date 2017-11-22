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
## 管理员模块
### 需求
管理员功能涉及管理员的增删改查。管理员登录、增加功能，数据库添加最后登录地址
自动登录令牌
### 流程
 设计数据库、创建模型、创建控制器、创建视图、填写代码、调试bug 
```php
createTable('admin', [
            'id' => $this->primaryKey(),
            'username'=>$this->string()->notNull()->defaultValue("游客")->comment("用户账号"),
            'password'=>$this->string()->notNull()->comment("用户密码"),
            'email'=>$this->string()->notNull()->comment("用户邮箱"),
            'token'=>$this->string()->comment("自动登录"),
            'create_at'=>$this->string()->comment("注册时间"),
            'update_at'=>$this->string()->comment("最后登录时间"),
            'login_ip'=>$this->string()->comment("最后登录地点")
        ]);
```
### 设计要点 
 自动登录，给密码加密加盐，安全存入数据库（数据库和页面交互）
 ### 要点难点及解决方案
 自动登录,提示当前登录用户下次登录时自动登录
 ```php
   public function actionIndex()
     {
         $model=new Admin();
         $request=\Yii::$app->request;
         if($request->isPost){
             $re=$request->post();
             //验证用户是否存在
             $admin=Admin::findOne(['username'=>$re['Admin']['username']]);
             if($admin){
                 //验证密码是否正确
                 if(\Yii::$app->security->validatePassword($re['Admin']['password'],$admin->password)){
                     $admin->token=\Yii::$app->security->generateRandomString();
                     $admin->update_at=time();
                     $admin->login_ip=\Yii::$app->request->getUserIP();
                     $admin->save();
                     if(!$re['Admin']['rememberMe']){
                         \Yii::$app->user->login($admin);
                     }else{
                         \Yii::$app->user->login($admin,3600*24*7);
                     }
                     return $this->redirect(['admin']);
                 }else{
                     $model->addError('password','密码错误');
                 }
             }else{
                 $model->addError('username','用户名不存在');
             }
 
         }
         return $this->render("login",['model'=>$model]);
     }
 ```
 ## rbac权限
 ### 需求
rbac功能涉及权限与角色与用户增删改查。管理员登录、增加功能，数据库添加最后登录地址
 自动登录令牌
 ### 流程
  设计数据库、创建模型、创建控制器、创建视图、填写代码、调试bug 
  ### 设计要点 
   创建权限，给角色添加权限，给用户添加角色
   ### 要点难点及解决方案
   给角色添加权限，编辑角色给角色添加多个权限，给用户添加多个角色

## 菜单管理

### 需求

菜单的增删改查
两级菜单
###  设计要点
无限级菜单

### 要点难点及解决方案

循环第一级菜单(parent_id=0),再根据当前的id循环出来它的子类(parent_id=id)

## 前台会员功能

### 需求

会员注册
会员登录
地址管理
### 设计要点

会员注册要短信验证
会员登录要实现自动登录
提示用layer插件来做
### 要点难点及解决方案

阿里大鱼已和阿里云合并,只能用阿里云的包
短信验证存Session Tel_13899996666=>985412
登录后要把Cookie里购物车数据同步到数据库中,同时清空本地购物车数据
验证码只能验证一次,save(false)
## 分类 列表 详情

### 需求

实现三级分类在头部显示
实现当前分类及子分类所有商品的数据(status=1)显示在列表页
实现商品详情页
### 设计要点

分类实现缓存技术
采用widget小挂件
利用放大镜技术提升用户体验
### 要点难点及解决方案

缓存 设置过期时间,后台添加分类之后要清空缓存
分类 在模型中设置一个得到当前子类的方法
子分类拼接 利用左值和右值当前树来处理 array_column()
取商品要加status
## 购物车

### 需求

实现购物车功能
### 设计要点

登录或未登录分别存储
用户登录之后会同步购物车数据
### 要点难点及解决方案
未登录存cook
  
## 订单
  ### 需求
  实现订单提交
  ### 设计要点
  订单提交，订单支付，统一下单，分别存入数据库
  ### 要点难点及解决方案
  下载插件easywechat
  订单提交成功清空购物车数据
  添加文件锁，解决大并发
  订单提交微信支付生成二维码
  