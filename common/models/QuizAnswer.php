<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%quiz_answer}}".
 *
 * @property int $answer_id
 * @property int $question_id
 * @property string $answer
 * @property int $category_id
 * @property int $post_id
 */
class QuizAnswer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%quiz_answer}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_id', 'answer'], 'required'],
            [['question_id', 'category_id', 'post_id'], 'integer'],
            [['answer'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'answer_id' => 'Answer ID',
            'question_id' => 'Question ID',
            'answer' => 'Answer',
            'category_id' => 'Category ID',
            'post_id' => 'Post ID',
        ];
    }
}
