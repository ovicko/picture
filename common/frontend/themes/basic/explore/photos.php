<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\LightBoxAsset;
use shiyang\masonry\Masonry;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

LightBoxAsset::register($this);

$this->params['title'] = Yii::t('app', 'Explore') . ' - ' . Yii::t('app', 'Photos');
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
');
?>
<div class="photo-index container-fluid">

    <h1><?= Html::encode($this->title) ?></h1>
<style type="text/css">
  .wrap {
     overflow: hidden;
     margin: 10px;
  }
  .box {
     float: left;
     position: relative;
     width: 20%;
     padding-bottom: 20%;
  }
  .boxInner {
     position: absolute;
     left: 10px;
     right: 10px;
     top: 10px;
     bottom: 10px;
     overflow: hidden;
  }
  .boxInner img {
     width: 100%;
  }
  .boxInner .titleBox {
     position: absolute;
     bottom: 0;
     left: 0;
     right: 0;
     margin-bottom: -50px;
     background: #000;
     background: rgba(0, 0, 0, 0.5);
     color: #FFF;
     padding: 10px;
     text-align: center;
     -webkit-transition: all 0.3s ease-out;
     -moz-transition: all 0.3s ease-out;
     -o-transition: all 0.3s ease-out;
     transition: all 0.3s ease-out;
  }

  .no-touch .boxInner:hover .titleBox, body.touch .boxInner.touchFocus .titleBox {
         margin-bottom: 0;
      }
</style>
    <?=
    \yii\widgets\ListView::widget([
        'dataProvider' => $listDataProvider,
        'options' => [
            'tag' => 'div',
            'class' => 'list-wrapper',
            'id' => 'list-wrapper',
        ],
        'layout' => "{pager}\n{items}\n{summary}",
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('_image_post',['model' => $model]);
        },
        'itemOptions' => [
            'tag' => false,
        ],
        'pager' => [
            'firstPageLabel' => 'first',
            'lastPageLabel' => 'last',
            'nextPageLabel' => 'next',
            'prevPageLabel' => 'previous',
            'maxButtonCount' => 3,
        ],
    ]);
    ?>

</div>
