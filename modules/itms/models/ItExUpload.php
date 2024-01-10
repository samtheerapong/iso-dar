<?php

namespace app\modules\itms\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * This is the model class for table "it_ex_upload".
 *
 * @property int $id
 * @property string|null $img_ref
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
            [['img_ref', 'title'], 'string', 'max' => 255],
            [['img_ref'], 'unique'],
            [['doc_ref'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'img_ref' => Yii::t('app', 'img_ref'),
            'doc_ref' => Yii::t('app', 'doc_ref'),
        ];
    }

    // uploading img
    public static function getUploadImagePath()
    {
        return Yii::getAlias('@webroot') . '/' . self::UPLOAD_FOLDER_IMG . '/';
    }

    public static function getUploadImageUrl()
    {
        return Url::base(true) . '/' . self::UPLOAD_FOLDER_IMG . '/';
    }

    public function getImageThumbnails($img_ref)
    {
        $uploadFiles   = UploadImg::find()->where(['ref' => $img_ref])->all();
        $preview = [];
        foreach ($uploadFiles as $file) {
            $preview[] = [
                'url' => self::getUploadImageUrl(true) . $img_ref . '/' . $file->real_filename,
                'src' => self::getUploadImageUrl(true) . $img_ref . '/thumbnail/' . $file->real_filename,
                'options' => [
                    'title' => $file->real_filename,
                ],
            ];
        }
        return $preview;
    }


    public function getImageShow()
    {
        $thumbnails = $this->getImageThumbnails($this->img_ref);
        if (!empty($thumbnails)) {
            return Html::a(Html::img($thumbnails[0]['src'], ['height' => '80px', 'class' => 'img-rounded']), ['view', 'id' => $this->id]);
        } else {
            return Html::a(Html::img(Yii::getAlias('@web') . '/uploads/no-image.jpg', ['height' => '80px', 'class' => 'img-rounded']), ['view', 'id' => $this->id]);
        }
    }

    // uploading doc
    public static function getUploadPathDoc()
    {
        return Yii::getAlias('@webroot') . '/' . self::UPLOAD_FOLDER_DOC . '/';
    }

    public static function getUploadUrlDoc()
    {
        return Url::base(true) . '/' . self::UPLOAD_FOLDER_DOC . '/';
    }
}
