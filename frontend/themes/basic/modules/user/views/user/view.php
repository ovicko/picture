<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\Nav;


/* @var $this yii\web\View */
/* @var $model common\models\User */
$this->title = $model->username;
$this->params['user'] = $model;
$this->params['profile'] = $model->profile;
$this->params['userData'] = $model->userData;


//follow button
$done = Yii::$app->db
    ->createCommand("SELECT 1 FROM {{%user_follow}} WHERE user_id=:user_id AND people_id=:id LIMIT 1")
    ->bindValues([':user_id' => Yii::$app->user->id, ':id' => $this->params['user']['id']])->queryScalar();
if ($done) {
    $followBtn = '<span class="glyphicon glyphicon glyphicon-eye-close"></span> ' . Yii::t('app', 'Unfollow');
} else {
    $followBtn = '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'Follow');
}

$this->registerJs("
    $('.follow').on('click', function () {
        var a = $(this);
        $.ajax({
            url: a.attr('href'),
            success: function (data) {
                if (data.action == 'create') {
                    a.html('Unfollow');
                } else {
                    a.html('Click to follow');
                }
            },
            error: function (XMLHttpRequest, textStatus) {
                location.href = '<?= Url::toRoute(['/site/login']) ?>';
            }
        });
        return false;
    });");
?>

<div class="row">
    <div class="col-sm-3">
        <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-sm-12 text-center">
                    <img src="<?= Yii::getAlias('@avatar') . $this->params['user']['avatar'] ?>" class="mx-auto d-block rounded-circle img-fluid" style="width: 100px; height: 100px;" alt="user-avatar">

                    <h4 class="mb-0 text-truncated text-centred"><?= Html::encode($this->params['user']['username']) ?></h4>
                </div>

                <div class="col-12 col-sm-4">
                    <h5 class="mb-0"><?= $this->params['userData']['follower_count'] ?></h5>
                    <small>Followers</small>
                    <button class="btn btn-success"> Follow</button>
                </div>
                <div class="col-12 col-sm-4">
                    <h5 class="mb-0"><?= $this->params['userData']['following_count'] ?></h5>
                    <small>Following</small>
                    <button class="btn btn-info"></span> Message</button>
                </div>
                <!--/col-->
            </div>
            <!--/row-->
        </div>
                        <!--/card-block-->
        </div>

    </div>

    <div class="col-sm-8">
        <div class="row">
         <?php if ($myPostsProvider->getModels()) { ?>
           <?php foreach ($myPostsProvider->getModels() as $model) { ?>
            <div class="col-sm-4" style="margin-bottom: 2.77rem;">
              <div class="card gedf-card">
                  <div class="card-body">
                      <a class="card-link" href="<?= Url::to(['/post/view','post' => $model->unique_id] )?>">
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
</div>
