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
            <img class="img-circle" src="<?= Yii::getAlias('@avatar') . $model->user->avatar ?>" style="width: 64px;height: 64px;">
        </a>
    </div>
    <div class="media-body">
        <div class="media-heading">
            <?= Html::a(Html::encode($model->user_name), ['/user/view', 'id' => $model->user_id]) ?>
        </div>
        <div class="media-content">
            <?= HtmlPurifier::process($model->comment) ?>
        </div>
        <div class="media-action">
            <a class="btn-comment" href="javascript:;"><?= Yii::t('app', 'Reply') ?></a>
        </div>
    </div>
</div>

