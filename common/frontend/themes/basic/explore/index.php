<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['title'] = Yii::t('app', 'Explore');
?>
<div class="row">
    <div class="col-md-8">
<h1>HELLO</h1>
    </div>
    <div class="col-md-4">
        <?= \app\widgets\login\Login::widget([
            'title' => Yii::t('app', 'Log in'),
            'visible' => Yii::$app->user->isGuest,
        ]); ?>
        <?php if (!Yii::$app->user->isGuest): ?>
        <div class="panel panel-default">
          <div class="panel-heading"><?= Yii::t('app', 'Trending') ?></div>
          <div class="panel-body" style="padding:0">
            <div class="list-group">

            </div>
          </div>
        </div>
        <?php endif; ?>
    </div>
</div>
