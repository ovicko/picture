<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%image_post_comment}}".
 *
 * @property int $comment_id
 * @property int $parent_comment_id
 * @property string $comment
 * @property int $user_id
 * @property string $date_added
 * @property string $user_name
 * @property int $post_id
 */
class ImagePostComment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%image_post_comment}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_comment_id', 'user_id', 'post_id'], 'integer'],
            [['comment','post_id'], 'required'],
            [['comment'], 'string'],
            [['date_added'], 'safe'],
            [['user_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'comment_id' => 'Comment ID',
            'parent_comment_id' => 'Parent Comment',
            'comment' => 'Comment',
            'user_id' => 'User ID',
            'date_added' => 'Date Added',
            'user_name' => 'User Name',
            'post_id' => 'Post ID',
        ];
    }

    /**
     * This is invoked before the record is saved.
     * @return boolean whether the record should be saved.
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->user_id = Yii::$app->user->id;
                $this->user_name = Yii::$app->user->identity->username;
                $this->date_added = date('Y-m-d H:i:s');
            }
            return true;
        } else {
            return false;
        }
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
