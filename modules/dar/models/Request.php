<?php

namespace app\modules\dar\models;

use app\models\User;
use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property string|null $document_code เลขที่เอกสาร
 * @property float|null $rev
 * @property int|null $request_type_id
 * @property int|null $request_category_id
 * @property int|null $department_id
 * @property string|null $request_name ผู้ร้องขอ
 * @property string|null $created_at สร้างเมื่อ
 * @property string|null $updated_at แก้ไขเมื่อ
 * @property int|null $created_by สร้างโดย
 * @property int|null $updated_by แก้ไขโดย
 * @property string|null $title
 * @property string|null $detail
 * @property int|null $document_age อายุการจัดเก็บ
 * @property string|null $public_date วันที่
 * @property int|null $request_status_id สถานะ
 *
 * @property Department $department
 * @property RequestCategory $requestCategory
 * @property RequestRule[] $requestRules
 * @property RequestStatus $requestStatus
 * @property RequestType $requestType
 * @property RequestUpload[] $requestUploads
 * @property Review[] $reviews
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['request_name','title','public_date','document_age'], 'required'],
            [['rev'], 'number'],
            [['request_type_id', 'request_category_id', 'department_id', 'created_by', 'updated_by', 'document_age', 'request_status_id'], 'integer'],
            [['created_at', 'updated_at', 'public_date'], 'safe'],
            [['detail'], 'string'],
            [['document_code'], 'string', 'max' => 45],
            [['request_name', 'title'], 'string', 'max' => 255],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::class, 'targetAttribute' => ['department_id' => 'id']],
            [['request_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => RequestCategory::class, 'targetAttribute' => ['request_category_id' => 'id']],
            [['request_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => RequestStatus::class, 'targetAttribute' => ['request_status_id' => 'id']],
            [['request_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => RequestType::class, 'targetAttribute' => ['request_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'document_code' => Yii::t('app', 'เลขที่เอกสาร'),
            'rev' => Yii::t('app', 'ริวิชั่น'),
            'request_type_id' => Yii::t('app', 'ประเภทการร้องขอ'),
            'request_category_id' => Yii::t('app', 'กลุ่มเอกสาร'),
            'department_id' => Yii::t('app', 'แผนก'),
            'request_name' => Yii::t('app', 'ผู้ร้องขอ'),
            'created_at' => Yii::t('app', 'สร้างเมื่อ'),
            'updated_at' => Yii::t('app', 'แก้ไขเมื่อ'),
            'created_by' => Yii::t('app', 'สร้างโดย'),
            'updated_by' => Yii::t('app', 'แก้ไขโดย'),
            'title' => Yii::t('app', 'หัวข้อ'),
            'detail' => Yii::t('app', 'รายละเอียด'),
            'document_age' => Yii::t('app', 'อายุการจัดเก็บ(ปี)'),
            'public_date' => Yii::t('app', 'วันที่ประกาศใช้'),
            'request_status_id' => Yii::t('app', 'สถานะ'),
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::class, ['id' => 'department_id']);
    }

    /**
     * Gets query for [[RequestCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestCategory()
    {
        return $this->hasOne(RequestCategory::class, ['id' => 'request_category_id']);
    }

    /**
     * Gets query for [[RequestRules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestRules()
    {
        return $this->hasMany(RequestRule::class, ['request_id' => 'id']);
    }

    /**
     * Gets query for [[RequestStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestStatus()
    {
        return $this->hasOne(RequestStatus::class, ['id' => 'request_status_id']);
    }

    /**
     * Gets query for [[RequestType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestType()
    {
        return $this->hasOne(RequestType::class, ['id' => 'request_type_id']);
    }

    /**
     * Gets query for [[RequestUploads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestUploads()
    {
        return $this->hasMany(RequestUpload::class, ['request_id' => 'id']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::class, ['request_id' => 'id']);
    }

    public function getRequestName()
    {
        return $this->hasOne(User::class, ['id' => 'request_name']);
    }
}
