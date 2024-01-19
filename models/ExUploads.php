<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

/**
 * This is the model class for table "ex_uploads".
 *
 * @property int $id
 * @property string|null $docs
 * @property string|null $images
 * @property string|null $ref
 */
class ExUploads extends \yii\db\ActiveRecord
{

    const UPLOAD_FOLDER = 'uploads/ex';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ex_uploads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ref'], 'string', 'max' => 50],
            [['docs'], 'file', 'maxFiles' => 10, 'skipOnEmpty' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'docs' => Yii::t('app', 'Docs'),
            'images' => Yii::t('app', 'Images'),
            'ref' => Yii::t('app', 'Ref'),
        ];
    }

    public static function getUploadPath()
    {
        return Yii::getAlias('@webroot') . '/' . self::UPLOAD_FOLDER . '/';
    }

    public static function getUploadUrl()
    {
        return Url::base(true) . '/' . self::UPLOAD_FOLDER . '/';
    }

    public function getThumbnails($ref)
    {
        $uploadFiles = Uploads::find()->where(['ref' => $ref])->all();
        $preview = [];
        foreach ($uploadFiles as $file) {
            $preview[] = [
                'url' => self::getUploadUrl(true) . $ref . '/' . $file->real_filename,
                'src' => self::getUploadUrl(true) . $ref . '/thumbnail/' . $file->real_filename,
                'options' => [
                    'title' => $this->id . '-' . $file->file_name,
                ],
            ];
        }
        return $preview;
    }

    public function listDownloadFiles($type)
    {
        $docs_file = '';
        if(in_array($type, ['docs','images'])){         
            $data = $type === 'docs' ? $this->docs : $this->images;
            $files = Json::decode($data);
            if (is_array($files)) {
                $docs_file = '<ul>';
                foreach ($files as $key => $value) {
                    $docs_file .= '<li>' . Html::a($value, ['/ex-uploads/download', 'id' => $this->id, 'file' => $key, 'file_name' => $value]) . '</li>';
                }
                $docs_file .= '</ul>';
            }
        }

        return $docs_file;
    }

    public function previewDocs($data, $field, $type = 'file')
    {
        $initial = [];
        $files = Json::decode($data);
        if (is_array($files)) {
            foreach ($files as $key => $value) {
                if ($type == 'file') {
                    $initial[] = "<div class='file-preview-other'><h2><i class='fa fa-file'></i></h2></div>";
                } elseif ($type == 'config') {
                    $initial[] = [
                        'caption' => $value,
                        'width'  => '120px',
                        'url'    => Url::to(['/ex-uploads/deletefile', 'id' => $this->id, 'fileName' => $key, 'field' => $field]),
                        'key'    => $key
                    ];
                } else {
                    $initial[] = Html::img(self::getUploadUrl() . $this->ref . '/' . $value, ['class' => 'file-preview-image', 'alt' => $this->ref, 'title' => $this->ref]);
                }
            }
        }
        return $initial;
    }
}
