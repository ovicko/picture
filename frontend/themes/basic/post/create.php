<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ImagePost */

$this->title = 'Upload Files';
$this->params['breadcrumbs'][] = ['label' => 'Image Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<div class="col-md-6 col-md-offset-2">
	    <h4><?= Html::encode($this->title) ?></h4>
	    <p>Upload files
	JPG, PNG ,MP4 . See Quality Guidelines...

	</p>

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
</div>


</div>
