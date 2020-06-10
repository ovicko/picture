<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\widgets\user\UserProfile;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model common\models\ImagePost */

$this->title = $model->post_id;
\yii\web\YiiAsset::register($this);

$commentModel = new \common\models\ImagePostComment();

$this->registerJs(
   '$("document").ready(function(){ 
        $("#new_comment_btn_'.$model->post_id.'").on("click", function(e) {
            
            postComment("#new_comment_form_'.$model->post_id.'",'.$model->post_id.')
        });
    });'
);

$this->registerCss('h1{float:left; width:100%; color:#232323; margin-bottom:30px; font-size: 14px;}
h1 span{font-family: "Libre Baskerville", serif; display:block; font-size:45px; text-transform:none; margin-bottom:20px; margin-top:30px; font-weight:700}
h1 a{color:#131313; font-weight:bold;}
  .card-img{
   width: 100%!important;
   object-fit: cover;
}
');
$this->registerJsFile('@web/js/jquery.timeago.js',['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJs('
  jQuery(document).ready(function() {
    jQuery("time.timeago").timeago();
  });

  jQuery(document).on("pjax:success", function(event){
              jQuery("time.timeago").timeago();
            }
          );

  function postComment (formElement,post_id) {
     $(formElement).on("beforeSubmit", function (e) {
      // e.preventDefault()
         var form = $(this);

         if (form.find(".has-error").length)  {
          $(form).trigger("reset");
             return false;
         }
         // submit form
         $("#new_comment_btn_"+post_id).off("click");

         $.ajax({
             url    : form.attr("action"),
             type   : "post",
             data   : form.serialize(),
             async:false,
             beforeSend : function(data){ 
                   $("#new_comment_btn_"+post_id).prop("disabled",true)
              },

            complete : function(data){ 
                   $("#new_comment_btn_"+post_id).prop("disabled",false)
            },
             success: function (response)  {
                $(form).trigger("reset");
                console.log(response)
                $.pjax.reload({container:"#post_comment_list_"+post_id,async: false}); 
             },
             error  : function () {
                 console.log("internal server error");
             }
         });
         return false;
      });
  }

');
?>
  <div class="row">
    <div class="col-sm-8">

      <div class="card">
          <img src="<?= Yii::$app->tools->resize('/uploads/posts/'.$model->thumbnail_url,900,640)  ?>" class="card-img img-fluid" style="margin-bottom: 2.77rem;" />
          <div class="card-body">
            <?php if ($quizAnswer) {

             foreach ($quizAnswer as $quiz) :  ?>
                   <h4><?= $quiz->question->content ?></h4>
                   <p><?= $quiz->answer ?></p>
            <?php endforeach ?>
            <?php } else { ?>
                <p>No Q&A for now</p>
            <?php } ?>
          </div>
      </div>

        <div class="clearfix"></div>
        <h4><strong>Comments</strong></h4>
        <div class="card" style="margin-bottom: 20px;"  data-post-id="<?php $model->post_id ?>" >
            <div class="card-body">
               
                    <?php if (!Yii::$app->user->isGuest) { ?>
                    <?php

                    $form = \yii\widgets\ActiveForm::begin([
                      'id' => 'new_comment_form_'.$model->post_id,
                      'action' => ['/post/add-comment'],
                      'enableAjaxValidation'=>false,
                      'enableClientValidation'=>true,
                      'options' => ['data-pjax' => true]
                    ]);?>

                    <?= $form->field($commentModel, 'post_id')->hiddenInput(['id' => 'new_comment_post_id_'.$model->post_id,'value'=> $model->post_id])->label(false) ?>
                    
                    <?= $form->field($commentModel, 'comment')->textarea(['class'=>'form-control','id' => 'new_comment_text_'.$model->post_id,'rows' => 2,'placeholder'=> 'Comment'])->label(false) ?>
                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'Comment'), [
                            'id' => 'new_comment_btn_'.$model->post_id,
                            'class' => 'btn btn-success pull-right']) ?>
                    </div>
                    <?php
                    \yii\widgets\ActiveForm::end();
                    ?>

                <?php } else { ?>
                    <h4>Login to comment</h4>
                <?php } ?>

                    <?php Pjax::begin(['id' => 'post_comment_list_'.$model->post_id, 'enablePushState'=>false, 'timeout' => 5000]); ?>
                       <?php \Yii::$app->runAction('/post/comment',['post_id' => $model->post_id ]); ?>
                    <?php Pjax::end(); ?>
            </div>
        </div>

    </div>
      <div class="col-sm-4">
          <?= UserProfile::widget(['user_id' => $model->user_id]) ?>
          <?= DetailView::widget([
              'model' => $model,
              'attributes' => [
                  //'post_id',
                  // 'unique_id',
                  // '',
                  [
                      'attribute' => 'category_id',
                      'value' => function($data) { 
                        return Html::a($data->category->category_name, ['post/category?category_id='.$data->category->category_id], ['option' => 'value']);
                    },
                      'label'=> 'Category',
                      'format'=> 'html'
                  ],
                  //'main_image_url:url',
                  //'user_id',
                  // '',
                  [
                      'attribute' => 'region_id',
                      'value' => function($data) { 
                        // return Html::a($data->category->city_name, ['post/category?category_id='.$data->category->city_id], ['option' => 'value']);
                        return $data->region->region_name;
                    },
                      'label'=> 'Region',
                      'format'=> 'html'
                  ],

                  [
                      'attribute' => 'country_id',
                      'value' => function($data) { 
                        // return Html::a($data->category->city_name, ['post/category?category_id='.$data->category->city_id], ['option' => 'value']);
                        return $data->country->country_name;
                    },
                      'label'=> 'Country',
                      'format'=> 'html'
                  ],
                  // '',
                  [
                      'attribute' => 'city_id',
                      'value' => function($data) { 
                        return $data->city->city_name;
                    },
                      'label'=> 'City',
                      'format'=> 'html'
                  ],
                  'views_count',
                  'resolution',
                  'camera',
                  'device_name',
                  'date_taken:datetime',
                  'date_added:datetime',
                  'tags:ntext',
                  // 'status',
                  //'thumbnail_url:url',
              ],
          ]) ?>

          <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->id == $model->user_id ) { ?>
              <p>
                  <?= Html::a('Delete', ['delete', 'id' => $model->post_id], [
                      'class' => 'btn btn-danger',
                      'data' => [
                          'confirm' => 'Are you sure you want to delete this item?',
                          'method' => 'post',
                      ],
                  ]) ?>
              </p>
          <?php } ?>
      </div>

  </div>  

