<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ImagePostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Image Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Image Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'post_id',
            'unique_id',
            'category_id',
            'main_image_url:url',
            'user_id',
            //'region_id',
            //'state_id',
            //'views_count',
            //'resolution',
            //'camera',
            //'device_name',
            //'date_taken',
            //'date_added',
            //'tags:ntext',
            //'status',
            //'thumbnail_url:url',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
