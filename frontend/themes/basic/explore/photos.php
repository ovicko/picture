<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$title = Yii::t('app', 'Explore') . ' - ' . Yii::t('app', 'Photos');

$this->title = $title;
$this->params['title'] = $title;
$this->params['breadcrumb'][] = Yii::t('app', 'Photos');
$this->registerCss('
  .overlay {
    position: absolute; 
    bottom: 0; 
    background: rgb(0, 0, 0);
    background: rgba(0, 0, 0, 0.5); /* Black see-through */
    color: #f1f1f1; 
    width: 100%;
    transition: .5s ease;
    opacity:0;
    color: white;
    font-size: 20px;
    padding: 20px;
    text-align: center;
  }

  .column:hover .overlay {
    opacity: 1;
  }

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  padding: 0 4px;
}

/* Create four equal columns that sits next to each other */
.column {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
  max-width: 25%;
  padding: 0 4px;
}

.column img {
  margin-top: 8px;
  vertical-align: middle;
  width: 100%;
}

/* Responsive layout - makes a two column-layout instead of four columns */
@media screen and (max-width: 800px) {
  .column {
    -ms-flex: 50%;
    flex: 50%;
    max-width: 50%;
  }
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column {
    -ms-flex: 100%;
    flex: 100%;
    max-width: 100%;
  }
}

.jumbotron {
    color: #2c3e50;
    background: #ecf0f1;
}
');
?>

    <div class="jumbotron jumbotron-fluid">

         <h1><span class="glyphicon glyphicon-camera"></span> The Picture Gallery</h1>
         <p>A bunch of images depicting daily life of users.</p>
         <p>Trending images might go here soon.</p>
    </div>
<div class="row">
  <?php foreach ($listDataProvider->getModels() as $photo): ?>
    <div class="column" style="position: relative;">
      <a href="<?= Url::to(['post/view?id='.$photo->post_id]) ?>">
      <img src="<?= Yii::getAlias('@web') .'/uploads/posts/'.$photo->thumbnail_url ?>" style="width: 100%; height: 284px" />
      <div class="overlay"><?= $photo->user->username ?></div>
      </a>
    </div>
  <?php endforeach ?>
  <?= LinkPager::widget([
      'pagination' => $listDataProvider->getPagination()
  ]); ?>
</div>
