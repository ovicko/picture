<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ImagePost */

$this->title = 'Update Image Post: ' . $model->post_id;
$this->params['breadcrumbs'][] = ['label' => 'Image Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->post_id, 'url' => ['view', 'id' => $model->post_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="image-post-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
