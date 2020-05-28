<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ImagePost */

$this->title = 'Search Results';
?>

<?= $this->render('/explore/photos', [
    'listDataProvider' => $listDataProvider,
]) ?>
