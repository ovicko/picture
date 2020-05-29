<?php
use yii\helpers\Html;
$this->registerCSS('.round-button { border-radius: 24px!important;}');
?>
<div class="media" style="padding-bottom: 20px;">
  <div class="media-left">
    <a href="#">
      <img class="media-object img-circle" src="<?= Yii::getAlias('@web') .'/uploads/user/avatar/'. $user->avatar ?>" style="width: 70px;height: 70px;">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading"><?= $user->username ?></h4>
    <button class="round-button btn btn-sm btn-success">Follow</button>
  </div>
</div>
<div class="clearfix"></div>
