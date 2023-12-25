<?php

namespace app\modules\engineer\models;

use app\models\User;
use app\modules\nfc\models\Department;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\BaseActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "en_rp".
 *
 * @property int $id
 * @property string|null $repair_code เลขที่เอกสาร
 * @property int|null $priority ความสำคัญ
 * @property int|null $urgency ความเร่งด่วน
 * @property string|null $created_date วันที่แจ้ง
 * @property int|null $request_by ผู้ร้องขอ
 * @property int|null $department แผนก
 * @property string|null $request_title หัวเรื่อง
 * @property string|null $remask หมายเหตุ
 * @property string|null $created_at จัดทำเมื่อ
 * @property string|null $updated_at ปรับปรุงเมื่อ
 * @property int|null $created_by ผู้จัดทำ
 * @property int|null $updated_by ปรับปรุงโดย
 * @property int|null $en_status_id สถานะ
 *
 * @property Department $department0
 * @property EnRpApprove[] $enRpApproves
 * @property EnRpList[] $enRpLists
 * @property EnStatus $enStatus
 * @property EnWo[] $enWos
 * @property EnPriority $priority0
 * @property EnUrgency $urgency0
 */
class Rp extends \yii\db\ActiveRecord
{
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
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'en_rp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['priority', 'urgency', 'request_by', 'department', 'created_by', 'updated_by', 'en_status_id'], 'integer'],
            [['created_date', 'created_at', 'updated_at'], 'safe'],
            [['remask'], 'string'],
            [['repair_code'], 'string', 'max' => 45],
            [['request_title'], 'string', 'max' => 255],
            [['department'], 'exist', 'skipOnError' => true, 'targetClass' => Department::class, 'targetAttribute' => ['department' => 'id']],
            [['priority'], 'exist', 'skipOnError' => true, 'targetClass' => Priority::class, 'targetAttribute' => ['priority' => 'id']],
            [['urgency'], 'exist', 'skipOnError' => true, 'targetClass' => Urgency::class, 'targetAttribute' => ['urgency' => 'id']],
            [['en_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['en_status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'repair_code' => Yii::t('app', 'เลขที่เอกสาร'),
            'request_title' => Yii::t('app', 'หัวเรื่อง'),
            'priority' => Yii::t('app', 'ความสำคัญ'),
            'urgency' => Yii::t('app', 'ความเร่งด่วน'),
            'created_date' => Yii::t('app', 'วันที่แจ้ง'),
            'request_by' => Yii::t('app', 'ผู้ร้องขอ'),
            'department' => Yii::t('app', 'แผนก'),
            'remask' => Yii::t('app', 'หมายเหตุ'),
            'created_at' => Yii::t('app', 'จัดทำเมื่อ'),
            'updated_at' => Yii::t('app', 'ปรับปรุงเมื่อ'),
            'created_by' => Yii::t('app', 'ผู้จัดทำ'),
            'updated_by' => Yii::t('app', 'ปรับปรุงโดย'),
            'en_status_id' => Yii::t('app', 'สถานะ'),
        ];
    }

    public function getDepartment0()
    {
        return $this->hasOne(Department::class, ['id' => 'department']);
    }

    public function getStatus0()
    {
        return $this->hasOne(Status::class, ['id' => 'en_status_id']);
    }

    public function getPriority0()
    {
        return $this->hasOne(Priority::class, ['id' => 'priority']);
    }

    public function getUrgency0()
    {
        return $this->hasOne(Urgency::class, ['id' => 'urgency']);
    }

    public function getRequestBy()
    {
        return $this->hasOne(User::class, ['id' => 'request_by']);
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }


    public function getWos()
    {
        return $this->hasMany(Wo::class, ['rp_id' => 'id']);
    }

    public function getApproves()
    {
        return $this->hasMany(RpApprove::class, ['wo_id' => 'id']);
    }

    public function getLists()
    {
        return $this->hasMany(RpList::class, ['request_id' => 'id']);
    }

}
