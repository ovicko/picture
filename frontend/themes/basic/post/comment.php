<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\HtmlPurifier;
use yii\widgets\LinkPager;


/* @var $this yii\web\View */
/* @var $model app\widgets\comment\models\Comment */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs('');
$this->registerCss('
    .comment-all {
        padding: 20px;
        background-color: #fff;
    }
    .comment-all header span {
        border-bottom:1px solid #ccc; line-height:22px;
        font-size: 1.6em
    }
');

?>

<div class="comment-all">
    <?=
    \yii\widgets\ListView::widget([
        'dataProvider' => $listDataProvider,
        'options' => [
            'tag' => 'div',
            'class' => 'media-list',
            'id' => 'list-wrapper',
        ],
        'layout' => "{pager}\n{items}\n{summary}",
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('_comment_item',['model' => $model]);
        },
        'itemOptions' => [
            'tag' => false,
        ],
        'emptyText' => "No comments yet,be the first one",
        'pager' => [
            'firstPageLabel' => 'first',
            'lastPageLabel' => 'last',
            'nextPageLabel' => 'next',
            'prevPageLabel' => 'previous',
            'maxButtonCount' => 3,
        ],
    ]);
    ?>
</div>


