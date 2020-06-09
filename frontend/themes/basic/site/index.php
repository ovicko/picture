<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Category;
$categories = Category::find()->all();

$categoryMenu = array();
foreach ($categories as $category) {
    $categoryMenu[] = array(
        'label' => $category->category_name,
        'url' => ['/explore/category?category_id='.$category->category_id]
    );

}

/* @var $this yii\web\View */
$this->title = 'Home';
$this->registerCss('
  body {
    padding-top: 0px !important;
    background-color: white;
  }
  .row {
    display: flex;
    flex-wrap: wrap;
    padding: 0 4px;
  }

  /* Create four equal columns that sits next to each other */
  .column {
    flex: 25%;
    max-width: 25%;
    padding: 0 4px;
  }

  .column a img {
    margin-top: 8px;
    vertical-align: middle;
    width: 100%;
  }

  /* Responsive layout - makes a two column-layout instead of four columns */
  @media screen and (max-width: 800px) {
    .column {
      flex: 50%;
      max-width: 50%;
    }
  }

  /* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
  @media screen and (max-width: 600px) {
    .column {
      flex: 100%;
      max-width: 100%;
    }
  }

  #overlay {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  cursor: pointer;
}

  #text{
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%,-50%);
-ms-transform: translate(-50%,-50%);
}
');
?>

<div class="row">
  <?php foreach ($posts as $post) { ?>
    <div class="column">
      <a class="card-link" href="<?= Url::to(['post/view','post' => $post->unique_id] )?>">
        <img src="<?= Yii::getAlias('@web').'/uploads/posts/'.$post->thumbnail_url  ?>" class="img-fluid" style="width: 100%;height: 100%;" />
      </a>
    </div>
  <?php } ?>
</div>

<div id="overlay" style="display:block;">
  <div id="text">
    <div class="card text-center bg-white border-rounded">
      <div class="card-body">
      <?php if (Yii::$app->user->isGuest) { ?>
        <h2 class="card-title">Welcome to Picture Power</h2>
        <p class="card-text">Join our ever growing community and access millions of images.</p>
        <p> <?= Html::a('Log in',['/site/login'], ['class'=>"btn btn-primary btn-md mw-50",'option' => 'value']); ?>
        </p>
        <p> <?= Html::a('Sign Up',['/site/signup'], ['class'=>"btn btn-danger btn-md mw-50",'option' => 'value']); ?></p>  
      <?php  } else { ?>
          <div class="dropdown card-title" style="padding: 50px;">
              <a href="#" data-toggle="dropdown" class="dropdown-toggle">Select Category <b class="caret"></b></a>
              <?php
                  echo yii\bootstrap4\Dropdown::widget([
                      'items' => $categoryMenu,
                  ]);
              ?>
          </div>
      <?php } ?>
      </div>
    </div>
  </div>
</div>
