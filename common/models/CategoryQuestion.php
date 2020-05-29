<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pre_category_question".
 *
 * @property int $question_id
 * @property string $content
 * @property int $category_id
 * @property int $status
 * @property string $date_added
 */
class CategoryQuestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%category_question}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'category_id', 'status', 'date_added'], 'required'],
            [['content'], 'string'],
            [['category_id', 'status'], 'integer'],
            [['date_added'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'question_id' => 'Question ID',
            'content' => 'Content',
            'category_id' => 'Category ID',
            'status' => 'Status',
            'date_added' => 'Date Added',
        ];
    }
}
