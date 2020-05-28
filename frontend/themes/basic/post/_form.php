<?php

use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\ActiveForm;

use kartik\depdrop\DepDrop;
use kartik\file\FileInput;

use yii\helpers\ArrayHelper;


use common\models\Category;
use common\models\Country;
/* @var $this yii\web\View */
/* @var $model common\models\ImagePost */
/* @var $form yii\widgets\ActiveForm */

$categories = Category::find()->all();
$categoryData = ArrayHelper::map($categories,'category_id','category_name');

$countries = Country::find()->all();
$countryList = ArrayHelper::map($countries,'country_id','country_name');

?>

<div class="image-post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'mainImageUrl')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*,video/*'],
        'name' => 'mainImageUrl',
        'pluginOptions' => [
            'showPreview' => true,
            'showCaption' => true,
            'showRemove' => true,
            'showUpload' => false
        ]
    ]); ?>

    <?= $form->field($model, 'category_id')->dropDownList(
        $categoryData,
        ['prompt'=>'--Select Category--']
        );
        ?>

    <?= $form->field($model, 'country_id')->dropDownList($countryList, ['id'=>'country-id','prompt'=>'--Select Country--']) ?>

    <?= $form->field($model, 'city_id')->widget(DepDrop::classname(), [
        'options'=>['id'=>'city-id'],
        'pluginOptions'=>[
            'depends'=>['country-id'],
            'placeholder'=>'--Select City--',
            'url' => Url::to(['/post/city-list'])
        ]
    ]); ?>

    <?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>
    <div class="form-group">
        <?= Html::submitButton('Post', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
