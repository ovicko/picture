<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\widgets\user\UserProfile;

/* @var $this yii\web\View */
/* @var $model common\models\ImagePost */

$this->title = $model->post_id;
\yii\web\YiiAsset::register($this);
$this->registerCss('.container { margin-left : 0px !important; } ');
?>
  <div class="row">
    <div class="col-md-10">

        <img src="<?= Yii::getAlias('@web') .'/uploads/posts/'.$model->thumbnail_url ?>" style="width: 100%" />
        <div class="clearfix"></div>
        <?php if ($quizAnswer) {

         foreach ($quizAnswer as $quiz) :  ?>
               <h4><?= $quiz->question->content ?></h4>
               <p><?= $quiz->answer ?></p>
        <?php endforeach ?>
        <?php } else { ?>
            <p>No Q&A for now</p>
        <?php } ?>

        <div class="clearfix"></div>
        <h4><strong>Comments</strong></h4>

    </div>
      <div class="col-md-2">
          <?= UserProfile::widget(['user_id' => $model->user_id]) ?>
          <?= DetailView::widget([
              'model' => $model,
              'attributes' => [
                  'post_id',
                  'unique_id',
                  'category_id',
                  'main_image_url:url',
                  'user_id',
                  'region_id',
                  'country_id',
                  'views_count',
                  'resolution',
                  'camera',
                  'device_name',
                  'date_taken',
                  'date_added',
                  'tags:ntext',
                  'status',
                  'thumbnail_url:url',
              ],
          ]) ?>

          <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->id == $model->user_id ) { ?>
              <p>
                  <?= Html::a('Delete', ['delete', 'id' => $model->post_id], [
                      'class' => 'btn btn-danger',
                      'data' => [
                          'confirm' => 'Are you sure you want to delete this item?',
                          'method' => 'post',
                      ],
                  ]) ?>
              </p>
          <?php } ?>
      </div>

  </div>  

