<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%image_post}}".
 *
 * @property int $post_id
 * @property string $unique_id
 * @property int $category_id
 * @property string $main_image_url
 * @property int $user_id
 * @property int $region_id
 * @property int $country_id
 * @property int $city_id
 * @property int $views_count
 * @property string $resolution
 * @property string $camera
 * @property string $device_name
 * @property string $date_taken
 * @property string $date_added
 * @property string $tags
 * @property int $status
 * @property string $thumbnail_url
 */
class ImagePost extends \yii\db\ActiveRecord
{
    
    public $mainImageUrl;

    const STATUS_ENABLED = 10;
    const STATUS_DISABLED = 9;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%image_post}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id','country_id','region_id', 'city_id'], 'required'],           

            [['category_id', 'user_id', 'region_id', 'country_id', 'city_id', 'views_count', 'status'], 'integer'],
            
            [['tags'], 'string'],

            [['unique_id'], 'string', 'max' => 16],
            ['unique_id', 'default', 'value' => \Yii::$app->util->token()],
            [['main_image_url', 'thumbnail_url'], 'string', 'max' => 60],

            [['resolution', 'camera'], 'string', 'max' => 100],
            [['device_name'], 'string', 'max' => 255],

            ['status', 'default', 'value' => self::STATUS_ENABLED],

            ['date_added', 'default', 'value' => date('Y-m-d H:i:s')],
            [['date_taken', 'date_added'], 'safe'],

            [['mainImageUrl'], 'file', 'skipOnEmpty' => true, 'on' => 'post-update','extensions' => 'jpeg,png,jpg,mp4'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'unique_id' => 'Unique Code',
            'category_id' => 'Category',
            'main_image_url' => 'File',
            'mainImageUrl' => 'File',
            'user_id' => 'User',
            'region_id' => 'Region',
            'country_id' => 'Country',
            'city_id' => 'City',
            'views_count' => 'Views Count',
            'resolution' => 'Resolution',
            'camera' => 'Camera',
            'device_name' => 'Device Name',
            'date_taken' => 'Date Taken',
            'date_added' => 'Date Added',
            'tags' => 'Tags',
            'status' => 'Status',
            'thumbnail_url' => 'Thumbnail',
        ];
    }

    /**
    * Process upload of image
    *
    * @return mixed the uploaded image instance
    */
    public function upload() {
        $fileName  = md5(time()).'_'.time() . '.' . $this->mainImageUrl->extension;

        $path = Yii::getAlias("@frontend").'/web/uploads/posts/'. $fileName;

       // $this->getImageProperties($path);
        
        if ($this->mainImageUrl->saveAs($path,false) ) {
           
            //$this->getImageProperties($path);

            return  $fileName;
        }
        return 'no_image_found.jpg';
    }

    public function getImageProperties($imagePath = ''){ 
        $exif = @exif_read_data($image);
        $this->device_name = $exif['Make'];
        $this->camera = $exif['Model'];

        $this->date_taken = (isset($exif['DateTimeOriginal']))  ?  $exif['DateTimeOriginal'] : $exif['DateTime'];

        $this->resolution = $exif['ImageWidth'].' x '.$exif['ImageLength'];

        if ($this->device_name == null || $this->date_taken == null || $this->camera == null || $this->resolution == null ) {
            $this->addError('mainImageUrl', 'Image info missing,upload an image taken by a Camera!');
        }   
    }

   //  public function beforeSave($insert) {

   //      if (parent::beforeSave($insert)) {
   //          if ($this->isNewRecord) {

   //              $this->region_id = Country::countryRegion($this->country_id);
   //          }
   //          return true; 
   //      } else {
   //          return false;
   //      }
   // }

   public function getCategory() {
       return $this->hasOne(Category::className(), ['category_id' => 'category_id']);
   }   

   public function getRegion() {
       return $this->hasOne(Region::className(), ['region_id' => 'region_id']);
   }   

   public function getCountry() {
       return $this->hasOne(Country::className(), ['country_id' => 'country_id']);
   }   

   public function getUser() {
       return $this->hasOne(User::className(), ['id' => 'user_id']);
   }

   public function getCity() {
       return $this->hasOne(City::className(), ['city_id' => 'city_id']);
   } 
}
