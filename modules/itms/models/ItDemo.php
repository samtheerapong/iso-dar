<?php

namespace app\modules\itms\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * This is the model class for table "it_demo".
 *
 * @property int $id
 * @property string $name
 * @property string $photo
 * @property string $photos
 */
class ItDemo extends \yii\db\ActiveRecord
{
    public $upload_foler = 'uploads';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'it_demo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['name', 'photo', 'photos'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['photo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg'],
            [['photos'], 'file', 'skipOnEmpty' => true, 'maxFiles' => 3, 'extensions' => 'png,jpg']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'photo' => Yii::t('app', 'Photo'),
            'photos' => Yii::t('app', 'Photos'),
        ];
    }

    public function uploadPhoto($model, $attribute)
    {
        $photo  = UploadedFile::getInstance($model, $attribute);
        $path = $this->getUploadPath();
        if ($this->validate() && $photo !== null) {

            $fileName = md5($photo->baseName . time()) . '.' . $photo->extension;
            if ($photo->saveAs($path . $fileName)) {
                return $fileName;
            }
        }
        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }

    public function uploadMultiple($model, $attribute)
    {
        $photos  = UploadedFile::getInstances($model, $attribute);
        $path = $this->getUploadPath();
        if ($this->validate() && $photos !== null) {
            $filenames = [];
            foreach ($photos as $file) {
                $filename = md5($file->baseName . time()) . '.' . $file->extension;
                if ($file->saveAs($path . $filename)) {
                    $filenames[] = $filename;
                }
            }
            if ($model->isNewRecord) {
                return implode(',', $filenames);
            } else {
                return implode(',', (ArrayHelper::merge($filenames, $model->getOwnPhotosToArray())));
            }
        }

        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }

    public function getOwnPhotosToArray()
    {
        return $this->getOldAttribute('photos') ? @explode(',', $this->getOldAttribute('photos')) : [];
    }


    public function getUploadPath()
    {
        return Yii::getAlias('@webroot') . '/' . $this->upload_foler . '/';
    }
    public function getUploadUrl()
    {
        return Yii::getAlias('@web') . '/' . $this->upload_foler . '/';
    }

    public function getPhotoViewer()
    {
        return empty($this->photo) ? Yii::getAlias('@web') . '/uploads/no-image.jpg' : $this->getUploadUrl() . $this->photo;
    }

    public function getPhotosViewer()
    {
        $photos = $this->photos ? @explode(',', $this->photos) : [];
        $img = '';
        foreach ($photos as  $image) {
            $img .= ' ' . Html::img($this->getUploadUrl() . $image, ['class' => 'img-thumbnail', 'style' => 'max-width:200px;']);
        }
        return $img;
    }
}
