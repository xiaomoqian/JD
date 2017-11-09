<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src=<?=Yii::getAlias("@web")?>"/upload/brand/1509702857.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>
                    <?php echo  isset(Yii::$app->user->identity->username)?Yii::$app->user->identity->username:'游客'?>
                </p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
<!--        <form action="#" method="get" class="sidebar-form">-->
<!--            <div class="input-group">-->
<!--                <input type="text" name="q" class="form-control" placeholder="Search..."/>-->
<!--              <span class="input-group-btn">-->
<!--                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>-->
<!--                </button>-->
<!--              </span>-->
<!--            </div>-->
<!--        </form>-->
<!--         /.search form-->

        <?= dmstr\widgets\Menu::widget([
            'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    //商品管理
                    [
                        'label'=>'商品管理',
                         'icon' => 'truck',
                        'items'=>[
                            ['label'=>'商品列表','icon' => 'imdb','url'=>['goods/index']],
//                            ['label'=>'添加商品','url'=>['goods/add']],
                            ['label'=>'分类列表','icon' => 'window-restore','url'=>['goods-category/index']],
//                            ['label'=>'添加分类','url'=>['goods-category/add']],
                            ['label'=>'品牌列表','icon' => 'cc-visa','url'=>['brand/index']],
//                            ['label'=>'添加品牌','url'=>['brand/add']],
                            ['label'=>'品牌回收站','icon' => 'trash','url'=>['brand/yin']],
                        ]
                    ],
                    //文章管理
                    [
                        'label'=>'文章管理',
                        'icon' => 'fa fa-address-card-o',
                        'items'=>[
                            ['label'=>'文章列表','icon' => 'fa fa-address-card','url'=>['article/index']],
//                            ['label'=>'添加文章','url'=>['article/add']],
                            ['label'=>'文章分类','icon' => 'fa fa-window-restore','url'=>['article/gory']],
//                            ['label'=>'添加分类','url'=>['article/ga']],
                        ]
                    ],
                    //用户管理
                    [
                        'label'=>'用户管理',
                        'icon' => 'users',
                        'items'=>[
                            ['label'=>'管理员列表','icon' => 'user-o','url'=>['admin/admin']],
                            ['label'=>'管理员注册','icon' => 'user-plus','url'=>['admin/add']],
                            ['label'=>'切换用户','icon' => 'reply-all','url'=>['admin/index']],
                        ]
                    ],
                    //项目完成，干掉
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Same tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
        ])?>

    </section>

</aside>
