<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

class HelperModel extends \yii\base\Model
{
    /**
     * Creates and populates a set of models.
     *
     * @param string $modelClass
     * @param array $multipleModels
     * @return array
     */
    public static function createMultiple($modelClass, $multipleModels = [])
    {
        $model    = new $modelClass;
        $formName = $model->formName();
        $post     = Yii::$app->request->post($formName);
        $models   = [];

        if (! empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, 'id', 'id'));
            $multipleModels = array_combine($keys, $multipleModels);
        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['id']) && !empty($item['id']) && isset($multipleModels[$item['id']])) {
                    $models[] = $multipleModels[$item['id']];
                } else {
                    $models[] = new $modelClass;
                }
            }
        }

        unset($model, $formName, $post);

        return $models;
    }

    public function resize($filepath, $width, $height) {
        if (!is_file($filepath)) {
            return;
        }

        $extension = pathinfo($filepath, PATHINFO_EXTENSION);

        $image_old = $filepath;
        $image_new = 'cache/' . utf8_substr($filepath, 0, utf8_strrpos($filepath, '.')) . '-' . (int)$width . 'x' . (int)$height . '.' . $extension;

        if (!is_file($image_new) || (filemtime($image_old) > filemtime($image_new))) {
            list($width_orig, $height_orig, $image_type) = getimagesize($image_old);
                 
            if (!in_array($image_type, array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF))) { 
                return $image_old;
            }
                        
            $path = '';

            $directories = explode('/', dirname($image_new));

            foreach ($directories as $directory) {
                $path = $path . '/' . $directory;

                if (!is_dir($path)) {
                    @mkdir($path, 0777);
                }
            }

            if ($width_orig != $width || $height_orig != $height) {
                $image = new \common\models\Image($image_old);
                $image->resize($width, $height);
                $image->save($image_new);
            } else {
                copy($image_old, $image_new);
            }
        }
        
        $image_new = str_replace(' ', '%20', $image_new);  // fix bug when attach image on email (gmail.com). it is automatic changing space " " to +
        
        return $image_new;
    }
}