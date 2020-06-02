
<div class="card gedf-card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex justify-content-between align-items-center">
                <div class="mr-2">
                    <img class="rounded-circle" width="45" src="<?= Yii::getAlias('@avatar'). $model->user->avatar ?>" alt="">
                </div>
                <div class="ml-2">
                    <div class="h5 m-0"><?= $model->user->username ?></div>
                    <div class="h7 text-muted"></div>
                </div>
            </div>
            <div>
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-h"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                        <a class="dropdown-item" href="#">Send Message</a>
                        <a class="dropdown-item" href="#">Unfollow</a>
                        <a class="dropdown-item" href="#">Report</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="card-body">
        <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>10 min ago</div>
        <a class="card-link" href="#">
            <h5 class="card-title">Photo caption holder to be addressed</h5>
        </a>

       	<img src="<?= Yii::getAlias('@web') .'/uploads/posts/'.$model->thumbnail_url ?>" class="img-fluid" style="width: 100%" />
    </div>
    <div class="card-footer">
        <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
        <a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a>
        <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
    </div>
</div>
