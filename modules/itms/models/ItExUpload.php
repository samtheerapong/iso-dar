<?php

namespace app\modules\itms\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
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
    const UPLOAD_FOLDER = 'uploads/ex/doc';

    const UPLOAD_FOLDER_IMG = 'uploads/ex/img';
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
            [['title'], 'string', 'max' => 255],
            // [['img_ref'], 'unique'],
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
            'docs' => Yii::t('app', 'Documents'),
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

    // uploading docs
    public static function getUploadPath()
    {
        return Yii::getAlias('@webroot') . '/' . self::UPLOAD_FOLDER . '/';
    }

    public static function getUploadUrl()
    {
        return Url::base(true) . '/' . self::UPLOAD_FOLDER . '/';
    }

    //********** List Downloads */
    public function listDownloadFiles($type)
    {
        $docs_file = '';
        if (in_array($type, ['docs'])) {
            $data = $type === 'docs' ? $this->docs : '';
            $files = Json::decode($data);
            if (is_array($files)) {
                $docs_file = '<ul>';
                foreach ($files as $key => $value) {
                    if (strpos($value, '.jpg') !== false || strpos($value, '.jpeg') !== false || strpos($value, '.png') !== false || strpos($value, '.gif') !== false) {
                        $thumbnail = Html::img(['/documents/download', 'id' => $this->id, 'file' => $key, 'fullname' => $value], ['class' => 'img-thumbnail', 'alt' => 'Image', 'style' => 'width: 150px']);
                        $fullSize = Html::a($thumbnail, ['/documents/download', 'id' => $this->id, 'file' => $key, 'fullname' => $value], ['target' => '_blank']);
                        $docs_file .= '<li>' . $fullSize . '</li>';
                    } else {
                        $docs_file .= '<li>' . Html::a($value, ['/documents/download', 'id' => $this->id, 'file' => $key, 'fullname' => $value]) . '</li>';
                    }
                }
                $docs_file .= '</ul>';
            }
        }

        return $docs_file;
    }

    //********** initialPreview */    
    public function isImage($filePath)
    {
        return @is_array(getimagesize($filePath)) ? true : false;
    }

    public function initialPreview($data, $field, $type = 'file')
    {
        $initial = [];
        $files = Json::decode($data);
        if (is_array($files)) {
            foreach ($files as $key => $value) {
                $filePath = self::getUploadUrl() . $this->ref . '/' . $value;
                $filePathDownload = self::getUploadUrl() . $this->ref . '/' . $value;

                $isImage = $this->isImage($filePath);

                if ($type == 'file') {
                    $initial[] = "<div class='file-preview-other'><h2><i class='glyphicon glyphicon-file'></i></h2></div>";
                } elseif ($type == 'config') {
                    $initial[] = [
                        'caption' => $value,
                        'width'  => '120px',
                        'url'    => Url::to(['/itms/it-ex-upload/deletefile', 'id' => $this->id, 'fileName' => $key, 'field' => $field]),
                        'key'    => $key
                    ];
                } else {
                    if ($isImage) {
                        $file = Html::img($filePath, ['class' => 'file-preview-image', 'alt' => $this->file_name, 'title' => $this->file_name]);
                    } else {
                        $file = Html::a('View File', $filePathDownload, ['target' => '_blank']);
                    }
                    $initial[] = $file;
                }
            }
        }
        return $initial;
    }
}
