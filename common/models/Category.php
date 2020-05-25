<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pre_category".
 *
 * @property int $category_id
 * @property string $category_name
 * @property int $parent_id
 * @property int $status
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pre_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_name', 'parent_id', 'status'], 'required'],
            [['parent_id', 'status'], 'integer'],
            [['category_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'category_name' => 'Category Name',
            'parent_id' => 'Parent ID',
            'status' => 'Status',
        ];
    }
}
