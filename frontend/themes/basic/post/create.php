<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ImagePost */

$this->title = 'Upload Files';
?>
<div class="row">
	<div class="col-md-6 gedf-main col-md-offset-2">
		<div class="card gedf-card">
		    <div class="card-header bg-white">
				<h4><?= Html::encode($this->title) ?></h4>
				<p>Upload files
					JPG, PNG ,MP4 . See Quality Guidelines...
				</p>
			</div>
		   <div class="card-body">
			<?= $this->render('_form', [
				'model' => $model,
			]) ?>
		</div>
	</div>
</div>
</div>
