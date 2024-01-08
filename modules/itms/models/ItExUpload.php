<?php

namespace app\modules\itms\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * This is the model class for table "it_ex_upload".
 *
 * @property int $id
 * @property string|null $ref
 * @property string|null $title
 */
class ItExUpload extends \yii\db\ActiveRecord
{

    const UPLOAD_FOLDER_IMG = 'uploads/ex/img';
    const UPLOAD_FOLDER_DOC = 'uploads/ex/doc';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'it_ex_upload';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ref', 'title'], 'string', 'max' => 255],
            [['ref'], 'unique']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ref' => Yii::t('app', 'Ref'),
            'title' => Yii::t('app', 'Title'),
        ];
    }

    // uploading img
    public static function getUploadPathImg()
    {
        return Yii::getAlias('@webroot') . '/' . self::UPLOAD_FOLDER_IMG . '/';
    }

    public static function getUploadUrlImg()
    {
        return Url::base(true) . '/' . self::UPLOAD_FOLDER_IMG . '/';
    }

    public function getThumbnailsImg($ref, $title)
    {
        $uploadFiles   = Uploads::find()->where(['ref' => $ref])->all();
        $preview = [];
        foreach ($uploadFiles as $file) {
            $preview[] = [
                'url' => self::getUploadUrlImg(true) . $ref . '/' . $file->real_filename,
                'src' => self::getUploadUrlImg(true) . $ref . '/thumbnail/' . $file->real_filename,
                'options' => ['title' => $title]
            ];
        }
        return $preview;
    }

    public function getPhotoIndexShow()
    {
        $thumbnails = $this->getThumbnailsImg($this->ref, $this->title);
        if (!empty($thumbnails)) {
            return Html::a(Html::img($thumbnails[0]['src'], ['height' => '80px', 'class' => 'img-rounded ']), ['view', 'id' => $this->id]);
        } else {
            return Html::a(Html::img(Yii::getAlias('@web') . '/uploads/no-image.jpg', ['height' => '80px', 'class' => 'img-rounded']), ['view', 'id' => $this->id]);
        }
    }


        // uploading doc
    public static function getUploadPathDoc()
    {
        return Yii::getAlias('@webroot') . '/' . self::UPLOAD_FOLDER_IMG . '/';
    }
}
