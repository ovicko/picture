<?php
namespace common\widgets\user;

use yii\base\Widget;
use yii\helpers\Html;
use common\models\User;
use yii\web\NotFoundHttpException;

class UserProfile extends Widget
{
    public $message;
    public $user_id;
    public $post_id;

    public function init()
    {
        parent::init();
        if ($this->user_id === null ) {
            //username
            //user followers
            //count photos
            //avatar
            throw new NotFoundHttpException('The requested user does not exist.');
        } 
    }

    public function run()
    {

        $user = User::find()->where(['id' => $this->user_id])->select(['username','avatar'])->one();
        // $query = new Query;
        // $query = $query->select('p.id, p.user_id, p.content, p.feed_data, p.template, p.created_at, u.username, u.avatar')
        //     ->from('{{%home_feed}} as p')
        //     ->join('LEFT JOIN','{{%user_follow}} as f', 'p.user_id=f.people_id AND f.user_id=:user_id')
        //     ->join('LEFT JOIN','{{%user}} as u', 'u.id=p.user_id')
        //     ->where('p.user_id=:user_id OR f.user_id=:user_id', [':user_id' => $model->id])
        //     ->orderBy('p.created_at DESC');
        
        // $pages = Yii::$app->tools->Pagination($query);
        
        return $this->render('user', [
            'user' => $user,
        ]);
    }
}