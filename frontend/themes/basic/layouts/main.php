<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\models\Category;
use common\models\Country;
use yii\bootstrap4\Modal;

$categories = Category::find()->all();

$categoryMenu = array();
foreach ($categories as $category) {
    $categoryMenu[] = array(
        'label' => $category->category_name,
        'url' => ['/post/category?category_id='.$category->category_id]
    );

}
$user = Yii::$app->user->identity;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="<?= Yii::getAlias('@web') ?>/favicon.ico">
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Picture',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar navbar-fixed-top navbar-expand-md navbar-light',
                    'style'=> 'background-color: #fcc573;'
                ],
            ]);

            $menuItems[] = [
                'label' => Yii::t('app', 'Home'), 'url' => ['/site/index'],
            ];            

            $menuItems[] = [
                'label' => Yii::t('app', 'Explore'), 'url' => ['/explore/index'],
            ];

            $menuItems[] = [
                'label' => 'Choose Categories',
                'items' => $categoryMenu
            ]; 

            $menuItems[] = [
                'label' => '<i class="glyphicon glyphicon-upload"></i> '.'Upload',
                'url' => ['/post/create']
            ];           


            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => Yii::t('app', 'Join'), 'url' => ['/site/signup']];
                $menuItems[] = ['label' =>  Yii::t('app', 'Log in'), 'url' => ['/site/login']];
            } else {
                $menuItems[] = ['label' => Yii::t('app', 'Dashboard'), 'url' => ['/user/dashboard']];
                $menuItems[] = [
                    'label' => Yii::$app->user->identity->username,
                    'items' => [
                         [
                            'label' => "<img src=".Yii::getAlias('@avatar'). $user->avatar." alt='User Avatar'>
                                <div class='detail'>
                                    <strong>". Html::encode($user->username)."</strong>
                                    <p class='grey'>".Html::encode($user->email)."</p>
                                </div>", 
                            'options'=> ['class'=>'dropdown-submenu'],
                            'linkOptions'=>['class'=>'dropdown-item'],

                        ],
                        [ 
                            'label' => 'My Profile',
                            'url' => ['/user/view', 'id' => $user->username],
                        ],                          

                        [ 
                            'label' => 'My Images',
                            'url' => ['/user/view', 'id' => $user->username],
                        ],
                        [ 
                            'label' => 'Messages',
                            'url' => ['/user/view', 'id' => $user->username],
                        ],                        

                        [ 
                            'label' => 'Settings',
                            'url' => ['/user/setting'],
                        ],  

                        '<a>' 
                            . Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                'Logout',
                                ['class' => 'btn btn-link logout']
                            )
                            . Html::endForm()
                        . '</a>',                      

                        // [ 
                        //     'label' => '<i class="glyphicon glyphicon-log-out"></i> Sign out',
                        //     'url' => '#',
                        //     'linkOptions'=> ['data-toggle' => "modal",'data-target' => "#logoutConfirm"],
                        // ],

                    ], 
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'encodeLabels' => false,
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container-fluid">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy;
         Picture Power <?= date('Y') ?>

        </p>
        </div>
    </footer>
    <?php
      Modal::begin([
          'id' => 'logoutConfirm',
          'title' => '<h2>' . Yii::t('app', 'Log out') . '</h2>',
          'footer' => Html::a(Yii::t('app', 'Log out'), ['/site/logout'], ['class' => 'btn btn-default'])
      ]);
      echo Yii::t('app', 'Are you sure you want to Log out?');
      Modal::end();
    ?>
    <?php $this->endBody() ?>
    <div style="display: none"><?= Yii::$app->setting->get('statisticsCode') ?></div>
</body>
</html>
<?php $this->endPage() ?>
