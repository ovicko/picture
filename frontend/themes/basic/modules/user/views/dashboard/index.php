<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title=Yii::$app->user->identity->username.' - '.Yii::t('app', 'Home');

// $userData = Yii::$app->userData->getKey(true);
?>

<div class="row">
    <div class="col-md-3">
                   <div class="card gedf-card border-rounded">
                    <div class="card-header bg-dark" style="color: #fff;">Trending</div>
                       <div class="card-body">
                           <h5 class="card-title">Trending photos</h5>
                       </div>
                   </div>
               </div>
</div>
