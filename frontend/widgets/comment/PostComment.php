<?php
/**
 * @link http://www.ovicko.com/
 * @copyright Copyright (c) 2020 
 * @license ovicko.com
 */

namespace app\widgets\comment;

use Yii;
use yii\base\Widget;
use common\models\ImagePostComment;

/**
 * @author Victor <vamwollo@gmail.com>
 */
class PostComment extends Widget
{

	/**
	 * @var 
	 */
	public $postId;

	public function init()
	{
	    if (empty($this->postId)) {
	        throw new InvalidConfigException('No post found!');
	    }

	}

	public function run()
	{
	    $listDataProvider = new \yii\data\ActiveDataProvider([
	        'query' => ImagePostComment::find()->where(['post_id' => $this->postId])->orderBy('date_added DESC'),
	        'pagination' => [
	            'pageSize' => 20,
	        ],
	    ]);
	    // $newComment = $this->newComment();
	    return $this->render('post_comment', [
	        'listDataProvider' => $listDataProvider,
	    ]);
	}

}