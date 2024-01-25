<?php

namespace app\modules\ncr\models;

use app\models\User;
use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

class NcrReply extends \yii\db\ActiveRecord
{

    const REPLY_FOLDER = 'uploads/ncr-reply';


    public static function tableName()
    {
        return 'ncr_reply';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ncr_id'], 'required'],
            [['ncr_id', 'reply_type_id', 'quantity'], 'integer'],
            [['method'], 'string'],
            [['operation_date', 'approve_date', 'operation_name', 'approve_name'], 'safe'],
            [['unit'], 'string', 'max' => 45],
            [['ref'], 'string', 'max' => 255],
            [['reply_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => NcrReplyType::class, 'targetAttribute' => ['reply_type_id' => 'id']],
            [['docs'], 'file', 'maxFiles' => 10, 'skipOnEmpty' => true]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ncr_id' => Yii::t('app', 'NCR'),
            'reply_type_id' => Yii::t('app', 'ประเภทการดำเนินการ'),
            'quantity' => Yii::t('app', 'จำนวน'),
            'unit' => Yii::t('app', 'หน่วย'),
            'method' => Yii::t('app', 'วิธีการ'),
            'operation_date' => Yii::t('app', 'วันที่ดำเนินการ'),
            'operation_name' => Yii::t('app', 'ผู้ดำเนินการ'),
            'approve_name' => Yii::t('app', 'ผู้อนุมัติ'),
            'approve_date' => Yii::t('app', 'วันที่อนุมัติ'),
            'docs' => Yii::t('app', 'แนบไฟล์'),
            'ref' => Yii::t('app', 'Ref'),
        ];
    }


    public function getNcrs()
    {
        return $this->hasOne(Ncr::class, ['id' => 'ncr_id']);
    }

    public function getReplyType()
    {
        return $this->hasOne(NcrReplyType::class, ['id' => 'reply_type_id']);
    }

    public function getOperator()
    {
        return $this->hasOne(User::class, ['id' => 'operation_name']);
    }

    public function getApprover()
    {
        return $this->hasOne(User::class, ['id' => 'approve_name']);
    }



    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!empty($this->process)) {
                $this->process = $this->setToArray($this->process);
            }
            return true;
        } else {
            return false;
        }
    }

    // upload files
    public function getArray($value)
    {
        return explode(',', $value);
    }

    public function setToArray($value)
    {
        return is_array($value) ? implode(',', $value) : NULL;
    }

    //********** Upload Path*/
    public static function getUploadPath()
    {
        return Yii::getAlias('@webroot') . '/' . self::REPLY_FOLDER . '/';
    }

    public static function getUploadUrl()
    {
        return Url::base(true) . '/' . self::REPLY_FOLDER . '/';
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
                        $thumbnail = Html::img(['/ncr/ncr-reply/download', 'id' => $this->id, 'file' => $key, 'fullname' => $value], ['class' => 'img-thumbnail', 'alt' => 'Image', 'style' => 'width: 150px']);
                        $fullSize = Html::a($thumbnail, ['/ncr/ncr-reply/download', 'id' => $this->id, 'file' => $key, 'fullname' => $value], ['target' => '_blank']);
                        $docs_file .= '<li class="mb-2">' . $fullSize . '</li>';
                    } else {
                        $docs_file .= '<li class="mb-2">' . Html::a($value, ['/ncr/ncr-reply/download', 'id' => $this->id, 'file' => $key, 'fullname' => $value]) . '</li>';
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

                if ($isImage = true) {
                    if ($type == 'file') {
                        $initial[] = Html::img($filePathDownload, ['class' => 'file-preview-image', 'alt' => $this->id, 'title' => $this->id]);
                    } elseif ($type == 'config') {
                        $initial[] = [
                            'caption' => $value,
                            'width'  => '120px',
                            'url'    => Url::to(['/ncr/ncr-reply/deletefile', 'id' => $this->id, 'fileName' => $key, 'field' => $field]),
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
        }
        return $initial;
    }
}
