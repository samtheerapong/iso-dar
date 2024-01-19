<?php

namespace app\modules\ncr\models;

use app\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\BaseActiveRecord;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

class Ncr extends \yii\db\ActiveRecord
{
    const UPLOAD_FOLDER = 'uploads/ncr';

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => ['created_at'],
                    self::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => function () {
                    return date('Y-m-d H:i:s');
                },
            ],
            [
                'class' => BlameableBehavior::class,
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_by', 'updated_by'],
                    BaseActiveRecord::EVENT_BEFORE_UPDATE => ['updated_by'],
                ],
            ],
        ];
    }

    public static function tableName()
    {
        return 'ncr';
    }

    public function rules()
    {
        return [
            [['created_date', 'production_date', 'created_at', 'updated_at'], 'safe'],
            [['month', 'year', 'department', 'ncr_process_id', 'category_id', 'sub_category_id', 'department_issue', 'report_by', 'ncr_status_id', 'created_by', 'updated_by'], 'integer'],
            [['datail', 'troubleshooting'], 'string'],
            [['ncr_number'], 'string', 'max' => 100],
            [['lot', 'product_name', 'customer_name'], 'string', 'max' => 255],
            [['ref'], 'string', 'max' => 45],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => NcrCategory::class, 'targetAttribute' => ['category_id' => 'id']],
            [['department_issue'], 'exist', 'skipOnError' => true, 'targetClass' => NcrDepartment::class, 'targetAttribute' => ['department_issue' => 'id']],
            [['department_issue'], 'exist', 'skipOnError' => true, 'targetClass' => NcrDepartment::class, 'targetAttribute' => ['department_issue' => 'id']],
            [['month'], 'exist', 'skipOnError' => true, 'targetClass' => NcrMonth::class, 'targetAttribute' => ['month' => 'id']],
            [['ncr_process_id'], 'exist', 'skipOnError' => true, 'targetClass' => NcrProcess::class, 'targetAttribute' => ['ncr_process_id' => 'id']],
            [['ncr_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => NcrStatus::class, 'targetAttribute' => ['ncr_status_id' => 'id']],
            [['sub_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => NcrSubCategory::class, 'targetAttribute' => ['sub_category_id' => 'id']],
            [['year'], 'exist', 'skipOnError' => true, 'targetClass' => NcrYear::class, 'targetAttribute' => ['year' => 'id']],
            [['docs'], 'file', 'maxFiles' => 10, 'skipOnEmpty' => true]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ncr_number' => Yii::t('app', 'เลขที่ NCR'),
            'created_date' => Yii::t('app', 'วันที่'),
            'month' => Yii::t('app', 'เดือน'),
            'year' => Yii::t('app', 'ปี'),
            'department' => Yii::t('app', 'ถึงแผนก'),
            'ncr_process_id' => Yii::t('app', 'กระบวนการ'),
            'lot' => Yii::t('app', 'หมายเลขล็อต'),
            'production_date' => Yii::t('app', 'วันที่ผลิต'),
            'product_name' => Yii::t('app', 'ชื่อสินค้า'),
            'customer_name' => Yii::t('app', 'ชื่อลูกค้า'),
            'category_id' => Yii::t('app', 'หมวดหมู่'),
            'sub_category_id' => Yii::t('app', 'หมวดหมู่ย่อย'),
            'datail' => Yii::t('app', 'รายละเอียดปัญหา'),
            'department_issue' => Yii::t('app', 'แผนกที่พบปัญหา'),
            'report_by' => Yii::t('app', 'ผู้รายงาน'),
            'troubleshooting' => Yii::t('app', 'การดำเนินการ'),
            'docs' => Yii::t('app', 'ไฟล์แนบ'),
            'ncr_status_id' => Yii::t('app', 'สถานะ'),
            'ref' => Yii::t('app', 'อ้างอิง'),
            'created_at' => Yii::t('app', 'สร้างเมื่อ'),
            'created_by' => Yii::t('app', 'สร้างโดย'),
            'updated_at' => Yii::t('app', 'ล่าสุดเมื่อ'),
            'updated_by' => Yii::t('app', 'ล่าสุดโดย'),
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(NcrCategory::class, ['id' => 'category_id']);
    }

    public function getToDepartment()
    {
        return $this->hasOne(NcrDepartment::class, ['id' => 'department']);
    }

    public function getDepartmentIssue()
    {
        return $this->hasOne(NcrDepartment::class, ['id' => 'department_issue']);
    }

    public function getMonth0()
    {
        return $this->hasOne(NcrMonth::class, ['id' => 'month']);
    }

    public function getNcrProcess()
    {
        return $this->hasOne(NcrProcess::class, ['id' => 'ncr_process_id']);
    }

    public function getNcrSolvings()
    {
        return $this->hasMany(NcrSolving::class, ['ncr_id' => 'id']);
    }

    public function getNcrStatus()
    {
        return $this->hasOne(NcrStatus::class, ['id' => 'ncr_status_id']);
    }

    public function getSubCategory()
    {
        return $this->hasOne(NcrSubCategory::class, ['id' => 'sub_category_id']);
    }

    public function getYear0()
    {
        return $this->hasOne(NcrYear::class, ['id' => 'year']);
    }

    public function getReportBy()
    {
        return $this->hasOne(User::class, ['id' => 'report_by']);
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }


    //********** Upload Path*/
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
                        $thumbnail = Html::img(['/ncr/ncr/download', 'id' => $this->id, 'file' => $key, 'fullname' => $value], ['class' => 'img-thumbnail', 'alt' => 'Image', 'style' => 'width: 150px']);
                        $fullSize = Html::a($thumbnail, ['/ncr/ncr/download', 'id' => $this->id, 'file' => $key, 'fullname' => $value], ['target' => '_blank']);
                        $docs_file .= '<li>' . $fullSize . '</li>';
                    } else {
                        $docs_file .= '<li>' . Html::a($value, ['/ncr/ncr/download', 'id' => $this->id, 'file' => $key, 'fullname' => $value]) . '</li>';
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
                            'url'    => Url::to(['/ncr/ncr/deletefile', 'id' => $this->id, 'fileName' => $key, 'field' => $field]),
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
