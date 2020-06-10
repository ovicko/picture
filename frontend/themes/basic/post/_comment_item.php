<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\HtmlPurifier;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="media" data-key="<?= $model->comment_id ?>">
    <div class="media-left">
        <a href="#">
            <img class="rounded-circle" width="30" src="<?= Yii::getAlias('@avatar') . $model->user->avatar ?>" >
        </a>
    </div>
    <div class="media-body">
        <div class="media-heading">
            <?= Html::a(Html::encode($model->user_name), ['/user/view', 'id' => $model->user_id]) ?>
            <span><time class="timeago" datetime="<?= $model->date_added ?>"><?= $model->date_added ?></time> </span>
        </div>
        <div class="media-content">
            <p><?= HtmlPurifier::process($model->comment) ?></p>
        </div>
    </div>
</div>

