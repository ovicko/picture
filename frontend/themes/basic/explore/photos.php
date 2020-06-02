<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$title = Yii::t('app', 'Explore') . ' - ' . Yii::t('app', 'Photos');

$this->title = $title;
$this->params['title'] = $title;
$this->params['breadcrumb'][] = Yii::t('app', 'Photos');
$this->registerCss('');
?>

<div class="row">
  <div class="col-md-3">
    <div class="card">
        <div class="card-body">
            <div class="h5">Amwollo</div>
            <div class="h7 text-muted">More work to be done</div>
            <div class="h7">Developer of web applications etc.
            </div>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <div class="h6 text-muted">Followers</div>
                <div class="h5">52342</div>
            </li>
            <li class="list-group-item">
                <div class="h6 text-muted">Following</div>
                <div class="h5">6758</div>
            </li>
        </ul>
    </div>
    <div class="card gedf-card border-rounded">
        <div class="card-body">
            <h5 class="card-title">Home</h5>
            <h5 class="card-title">Notifications</h5>
            <h5 class="card-title">Messages</h5>
            <h5 class="card-title">Profile</h5>
            <h5 class="card-title">Help</h5>
        </div>
    </div>
  </div>
  <div class="col-md-6 gedf-main">
    <div class="card gedf-card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Video </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="images-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#images">Images</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                    <div class="form-group">
                        <label class="sr-only" for="message">Post</label>
                        <textarea class="form-control" id="message" rows="3" placeholder="What are you thinking?"></textarea>
                    </div>

                </div>
                <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Upload image</label>
                        </div>
                    </div>
                    <div class="py-4"></div>
                </div>
            </div>
            <div class="btn-toolbar justify-content-between">
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">share</button>
                </div>
                <div class="btn-group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="fa fa-globe"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#"><i class="fa fa-globe"></i> Public</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-users"></i> Friends</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Just me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?=
    \yii\widgets\ListView::widget([
        'dataProvider' => $listDataProvider,
        'options' => [
            'tag' => 'div',
            'class' => 'list-wrapper',
            'id' => 'list-wrapper',
        ],
        'layout' => "{pager}\n{items}\n{summary}",
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('_image_post',['model' => $model]);
        },
        'itemOptions' => [
            'tag' => false,
        ],
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
  <div class="col-md-3">
                 <div class="card gedf-card border-rounded">
                  <div class="card-header bg-dark" style="color: #fff;">Trending</div>
                     <div class="card-body">
                         <h5 class="card-title">Trending photos</h5>
                     </div>
                 </div>
             </div>
</div>
