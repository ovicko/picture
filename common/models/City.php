<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pre_city".
 *
 * @property int $city_id
 * @property int $country_id
 * @property string $city_name
 * @property int $region_id
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pre_city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_id', 'city_name', 'region_id'], 'required'],
            [['country_id', 'region_id'], 'integer'],
            [['city_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'city_id' => 'City ID',
            'country_id' => 'Country ID',
            'city_name' => 'City Name',
            'region_id' => 'Region ID',
        ];
    }
}
