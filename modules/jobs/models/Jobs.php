<?php

namespace app\modules\jobs\models;

use app\models\Department;
use app\models\Location;
use app\models\User;
use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

/**
 * This is the model class for table "jobs".
 *
 * @property int $id
 * @property string|null $number
 * @property string|null $request_date
 * @property string|null $title
 * @property string|null $description
 * @property int|null $request_by
 * @property int|null $job_department
 * @property int|null $location
 * @property string|null $equipment
 * @property int|null $job_type
 * @property int|null $urgency
 * @property int|null $job_status
 * @property string|null $remask
 * @property string|null $docs
 *
 * @property Department $jobDepartment
 * @property JobStatus $jobStatus
 * @property JobType $jobType
 * @property Location $location0
 * @property Operations[] $operations
 * @property JobUrgency $urgency0
 */
class Jobs extends \yii\db\ActiveRecord
{

    const UPLOAD_FOLDER = 'uploads/request';


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jobs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['title', 'request_date', 'job_department', 'location', 'request_by', 'job_department', 'location', 'job_type', 'urgency', 'job_status'], 'required'],
            [['request_date'], 'safe'],
            [['description', 'remask'], 'string'],
            [['request_by', 'job_department', 'location', 'job_type', 'urgency', 'job_status'], 'integer'],
            [['number'], 'string', 'max' => 45],
            [['title', 'equipment'], 'string', 'max' => 255],
            [['job_department'], 'exist', 'skipOnError' => true, 'targetClass' => Department::class, 'targetAttribute' => ['job_department' => 'id']],
            [['job_status'], 'exist', 'skipOnError' => true, 'targetClass' => JobStatus::class, 'targetAttribute' => ['job_status' => 'id']],
            [['job_type'], 'exist', 'skipOnError' => true, 'targetClass' => JobType::class, 'targetAttribute' => ['job_type' => 'id']],
            [['urgency'], 'exist', 'skipOnError' => true, 'targetClass' => JobUrgency::class, 'targetAttribute' => ['urgency' => 'id']],
            [['location'], 'exist', 'skipOnError' => true, 'targetClass' => Location::class, 'targetAttribute' => ['location' => 'id']],
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
            'number' => Yii::t('app', 'Number'),
            'request_date' => Yii::t('app', 'Request Date'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'request_by' => Yii::t('app', 'Request By'),
            'job_department' => Yii::t('app', 'Job Department'),
            'location' => Yii::t('app', 'Location'),
            'equipment' => Yii::t('app', 'Equipment'),
            'job_type' => Yii::t('app', 'Job Type'),
            'urgency' => Yii::t('app', 'Urgency'),
            'job_status' => Yii::t('app', 'Job Status'),
            'remask' => Yii::t('app', 'Remask'),
            'docs' => Yii::t('app', 'Docs'),
        ];
    }

    /**
     * Gets query for [[JobDepartment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJobDepartment()
    {
        return $this->hasOne(Department::class, ['id' => 'job_department']);
    }

    /**
     * Gets query for [[JobStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJobStatus()
    {
        return $this->hasOne(JobStatus::class, ['id' => 'job_status']);
    }

    /**
     * Gets query for [[JobType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJobType()
    {
        return $this->hasOne(JobType::class, ['id' => 'job_type']);
    }

    /**
     * Gets query for [[Location0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocation0()
    {
        return $this->hasOne(Location::class, ['id' => 'location']);
    }

    /**
     * Gets query for [[Operations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOperations()
    {
        return $this->hasMany(Operations::class, ['job_id' => 'id']);
    }

    /**
     * Gets query for [[Urgency0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUrgency0()
    {
        return $this->hasOne(JobUrgency::class, ['id' => 'urgency']);
    }

    public function getRequestBy()
    {
        return $this->hasOne(User::class, ['id' => 'request_by']);
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
        $image = Html::img(['/jobs/jobs/download', 'id' => $this->id, 'file' => $key, 'fullname' => $value], ['class' => 'img-thumbnail', 'alt' => 'Image', 'style' => 'width: 250px']);
        $fullSize = Html::a($image, ['/jobs/jobs/download', 'id' => $this->id, 'file' => $key, 'fullname' => $value], ['target' => '_blank']);
        return $fullSize;
    }

    public function listFiles($key, $value)
    {
        $files = Html::a($value, ['/jobs/jobs/download', 'id' => $this->id, 'file' => $key, 'fullname' => $value]);
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
                $filePath = self::getUploadUrl() . $this->number . '/' . $value;
                $filePathDownload = self::getUploadUrl() . $this->number . '/' . $value;

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
