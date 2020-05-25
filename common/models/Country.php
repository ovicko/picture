<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pre_country".
 *
 * @property int $country_id
 * @property int $region_id
 * @property string $country_name
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pre_country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id', 'country_name'], 'required'],
            [['region_id'], 'integer'],
            [['country_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'country_id' => 'Country ID',
            'region_id' => 'Region ID',
            'country_name' => 'Country Name',
        ];
    }

    public static function countryRegion($country_id=0)
    {
        $country = self::find()->where(['country_id' => $country_id])->select('region_id')->one();

        return $country->region_id;
    }
}
