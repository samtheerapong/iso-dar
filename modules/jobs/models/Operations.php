<?php

namespace app\modules\jobs\models;

use app\models\User;
use Yii;
use yii\bootstrap4\Html;
use yii\helpers\Json;
use yii\helpers\Url;

/**
 * This is the model class for table "operations".
 *
 * @property int $id
 * @property int|null $job_id
 * @property int|null $operator_by
 * @property string|null $details
 * @property string|null $sparepart_list
 * @property float|null $cost
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $remask
 * @property string|null $docs
 *
 * @property Jobs $job
 */
class Operations extends \yii\db\ActiveRecord
{

    public $title;
    const UPLOAD_FOLDER = 'uploads/operation';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'operations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['job_id', 'operator_by','start_date', 'end_date','cost'], 'required'],
            [['job_id', 'operator_by'], 'integer'],
            [['details', 'sparepart_list', 'remask', 'title'], 'string'],
            [['cost'], 'number'],
            [['start_date', 'end_date'], 'safe'],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jobs::class, 'targetAttribute' => ['job_id' => 'id']],
            [['docs'], 'file', 'maxFiles' => 10, 'skipOnEmpty' => true]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'job_id' => Yii::t('app', 'Job ID'),
            'operator_by' => Yii::t('app', 'Operator By'),
            'details' => Yii::t('app', 'Details'),
            'sparepart_list' => Yii::t('app', 'Sparepart List'),
            'cost' => Yii::t('app', 'Cost'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
            'remask' => Yii::t('app', 'Remask'),
            'docs' => Yii::t('app', 'Docs'),
            // Jobs
            'job_status' => Yii::t('app', 'Job Status'),
            'request_by' => Yii::t('app', 'Request By'),
            'job_department' => Yii::t('app', 'Job Department'),
            'title' => Yii::t('app', 'Title'),
        ];
    }


    // กำหนดความสัมพันธ์ของตาราง job_id
    public function getJob()
    {
        return $this->hasOne(Jobs::class, ['id' => 'job_id']);
    }


    // กำหนดความสัมพันธ์ของตาราง operator_by
    public function getActorBy()
    {
        return $this->hasOne(User::class, ['id' => 'operator_by']);
    }


    // set format  Ex-> 12 ก.ย. 2023 เวลา 14:45 น.
    function formatDateTime($timestamp)
    {
        if ($timestamp !== null) {
            $monthNames = [
                'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.',
                'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.',
                'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'
            ];
            $day = date('d', $timestamp);
            $month = $monthNames[date('n', $timestamp) - 1];
            $year = date('Y', $timestamp);
            $time = ": " . date('H:i', $timestamp);
            return "$day $month $year $time";
        } else {
            return null;
        }
    }


    // set format  Ex-> 1,999.00
    public function getFormattedCost()
    {
        if ($this->cost !== null) {
            return Yii::$app->formatter->asDecimal($this->cost, 2);
        }
        return '';
    }


    // set format ตัดคำที่ 20 อักษร และเพิ่ม ... ต่อท้าย ตามด้วยกดที่ข้อความแล้วไปที่ view/:id
    public function generateTitleLink()
    {
        $truncatedTitle = mb_substr($this->job->title, 0, 18, 'UTF-8');
        if (mb_strlen($this->job->title, 'UTF-8') > 18) {
            $truncatedTitle .= '...';
        }

        $tooltipContent = $this->job->title .' '.$this->job->description;
        $tooltipLink = '<span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" title="' . $tooltipContent . '">'
            . Html::encode($truncatedTitle)
            . '</span>';

        return Html::a($tooltipLink, ['view', 'id' => $this->id]);
    }

    // set format แสดงสีสถานะ และกำหนดสถานะ = 1(แจ้งงาน) ให้กระพริบ
    public function getFormattedJobStatus()
    {
        $blinkClass = ($this->job->jobStatus->id == 1) ? 'blink' : '';
        return Html::a(
            '<span class="text-justify ' . $blinkClass . '" style="color:' . $this->job->jobStatus->color . ';"><b>' . $this->job->jobStatus->name . '</b></span>',
            ['view', 'id' => $this->id]
        );
    }


    // *************************** Uploads ********************************************************

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
         $docs_file = ''; // เริ่มต้นตัวแปรเป็นสตริงว่าง
         if ($type === 'docs') { // ตรวจสอบประเภท
             $data = $this->docs; // นำข้อมูลมาจาก $this->docs ในกรณีนี้
             $files = Json::decode($data);
 
             if (is_array($files)) {
                 $docs_file = '<ul>';
                 foreach ($files as $key => $value) {
                     // ใช้ pathinfo เพื่อรับข้อมูลของไฟล์
                     $fileInfo = pathinfo($value);
 
                     if (isset($fileInfo['extension'])) {
                         $extension = strtolower($fileInfo['extension']);
 
                         if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                             // นี่คือรูปภาพ
                             $docs_file .= '<li>' . $this->listImages($key, $value) . '</li>';
                         } else {
                             // ไม่ใช่รูปภาพ
                             $docs_file .= '<li>' . $this->listFiles($key, $value) . '</li>';
                         }
                     }
                 }
                 $docs_file .= '</ul>';
             }
         }
 
         return $docs_file;
     }

     public function listImages($key, $value)
     {
         $image = Html::img(['/jobs/operations/download', 'id' => $this->id, 'file' => $key, 'fullname' => $value], ['class' => 'img-thumbnail', 'alt' => 'Image', 'style' => 'width: 250px']);
         $fullSize = Html::a($image, ['/jobs/operations/download', 'id' => $this->id, 'file' => $key, 'fullname' => $value], ['target' => '_blank']);
         return $fullSize;
     }
 
     public function listFiles($key, $value)
     {
         $files = Html::a($value, ['/jobs/operations/download', 'id' => $this->id, 'file' => $key, 'fullname' => $value]);
         return $files;
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
                $filePath = self::getUploadUrl() . $this->id . '/' . $value;
                $filePathDownload = self::getUploadUrl() . $this->id . '/' . $value;

                $isImage = $this->isImage($filePath);

                if ($type == 'file') {
                    $initial[] = "<div class='file-preview-other'><h2><i class='glyphicon glyphicon-file'></i></h2></div>";
                } elseif ($type == 'config') {
                    $initial[] = [
                        'caption' => $value,
                        'width'  => '120px',
                        'url'    => Url::to(['deletefile', 'id' => $this->id, 'fileName' => $key, 'field' => $field]),
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
