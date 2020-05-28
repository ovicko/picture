<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$title = Yii::t('app', 'Explore') . ' - ' . Yii::t('app', 'Photos');

$this->title = $title;
$this->params['title'] = $title;
$this->params['breadcrumb'][] = Yii::t('app', 'Photos');
$this->registerCss('
.photo-index {
  padding:0
}
.photo-item {
      background: #fcfcfc;
      margin-bottom: 20px;
      -moz-border-radius: 3px;
      -webkit-border-radius: 3px;
      border-radius: 3px;
      -moz-box-shadow: 0 3px 0 rgba(12,12,12,0.03);
      -webkit-box-shadow: 0 3px 0 rgba(12,12,12,0.03);
      box-shadow: 0 3px 0 rgba(12,12,12,0.03);
      position: relative;
}
.photo-img img {
  -moz-border-radius: 3px 3px 0 0;
  -webkit-border-radius: 3px 3px 0 0;
  border-radius: 3px 3px 0 0;
}
.photo-details {
  padding: 10px;
  font-weight: bold;
  border-top: 1px solid #e7e7e7;
  color: #777;
  line-height: 15px;
  font-size: 11px;
}
.photo-details:hover {
  background: #f1f1f1;
}
.photo-title {
  margin: 0;
  font-weight: normal;
}
.user-image, .user-image img {
    position: relative;
  border-radius: 2px;
  float: left;
  height: 30px;
  margin-right: 5px;
  width: 30px;
}
.photo-at {
  white-space: nowrap;
  overflow: hidden;
  -ms-text-overflow: ellipsis;
  text-overflow: ellipsis;
}
.album-title {
  white-space: nowrap;
  overflow: hidden;
  -ms-text-overflow: ellipsis;
  text-overflow: ellipsis;
  overflow: hidden;
  display: block;
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
');
?>
<div class="row">
  <?php foreach ($listDataProvider->getModels() as $photo): ?>
    <div class="column">
      <img src="<?= Yii::getAlias('@web') .'/uploads/posts/'.$photo->thumbnail_url ?>" style="width: 100%" />
      <!-- <div class="titleBox">Test Post <?= $photo->post_id ?></div> -->
    </div>
  <?php endforeach ?>
  <?= LinkPager::widget([
      'pagination' => $listDataProvider->getPagination()
  ]); ?>
</div>
