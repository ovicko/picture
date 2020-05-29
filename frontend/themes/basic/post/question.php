<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
// use wbraganca\dynamicform\DynamicFormWidget;
/* @var $this yii\web\View */
/* @var $model common\models\ImagePost */
/* @var $form yii\widgets\ActiveForm */
// print_r($questions);
// exit();
?>

<div class="image-post-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->errorSummary($answerModel); ?>

    <?php foreach ($questions as $i => $question) { ?>
        <?= $form->field($answerModel, '['.$i.']question_id')->hiddenInput(['value'=> $question->question_id])->label($question->content) ?>
        <?= $form->field($answerModel, '['.$i.']answer')->textInput(['placeholder'=>'Answer'])->label(false) ?>
    <?php } ?>
    <div class="form-group">
        <?= Html::submitButton('Post', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
