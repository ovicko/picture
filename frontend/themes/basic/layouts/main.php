<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\models\Category;
use common\models\Country;

$categories = Category::find()->all();

$categoryMenu = array();
foreach ($categories as $category) {
    $categoryMenu[] = array(
        'label' => $category->category_name,
        'url' => "#".$category->category_id
    );

}

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
                    'class' => 'navbar-custom navbar-fixed-top',
                ],
            ]);

            $menuItems = [
                ['label' => Yii::t('app', 'Explore'), 'url' => ['/explore/index']],
            ];

            $menuItems[] = [
                'label' => 'Picture Categories',
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
                    'label' => '<i class="glyphicon glyphicon-log-out"></i> ' . Yii::t('app', 'Log out') . '(' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'encodeLabels' => false,
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy;
         <?= Html::a(Yii::$app->setting->get('siteName'), ['/site/index']) ?> <?= date('Y') ?>

        </p>
        </div>
    </footer>
    <?php $this->endBody() ?>
    <div style="display: none"><?= Yii::$app->setting->get('statisticsCode') ?></div>
</body>
</html>
<?php $this->endPage() ?>
