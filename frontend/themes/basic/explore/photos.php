<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$title = Yii::t('app', 'Explore') . ' - ' . Yii::t('app', 'Photos');

$this->title = $title;

$commentModel = new \common\models\ImagePostComment();

$this->registerCss('h1{float:left; width:100%; color:#232323; margin-bottom:30px; font-size: 14px;}
h1 span{font-family: "Libre Baskerville", serif; display:block; font-size:45px; text-transform:none; margin-bottom:20px; margin-top:30px; font-weight:700}
h1 a{color:#131313; font-weight:bold;}

  .card-img{
   width: 100%!important;
   height: 200px !important;
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
  <div class="col-md-9 gedf-main">

    <div class="row">
      <?php if ($listDataProvider->getModels()) { ?>
        <?php foreach ($listDataProvider->getModels() as $model) { ?>
         <div class="col-sm-4" style="margin-bottom: 2.77rem;">
           <div class="card gedf-card">
               <div class="card-body">
                   <a class="card-link" href="<?= Url::to(['post/view','post' => $model->unique_id] )?>">
                    <img src="<?= Yii::$app->tools->resize('/uploads/posts/'.$model->thumbnail_url,200,200)  ?>" class="card-img img-fluid" />
                   </a>
               </div>
           </div>
         </div>
       <?php } ?>
     <?php } else { ?>
        <h4>No results found</h4>
      <?php } ?>
    </div>
  </div>
  <div class="col-md-3">
                 <div class="card gedf-card border-rounded">
                  <div class="card-header bg-dark" style="color: #fff;">Trending</div>
                     <div class="card-body">
                         <h5 class="card-title">Trending photos</h5>
                     </div>
                 </div>
             </div>
</div>
