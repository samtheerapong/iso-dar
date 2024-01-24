<?php

namespace app\modules\ncr\models;

use app\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\BaseActiveRecord;

/**
 * This is the model class for table "ncr_reply".
 *
 * @property int $id
 * @property int|null $ncr_id NCR
 * @property int|null $reply_type_id ประเภทการดำเนินการ
 * @property int|null $quantity จำนวน
 * @property string|null $unit หน่วย
 * @property string|null $proceed วิธีการ
 * @property string|null $operation_date วันที่ดำเนินการ
 * @property int|null $operation_name ผู้ดำเนินการ
 * @property int|null $approve_name ผู้อนุมัติ
 * @property string|null $approve_date วันที่อนุมัติ
 * @property string|null $docs แนบไฟล์
 * @property string|null $ref Ref
 *
 * @property Ncr $ncr
 * @property NcrReplyType $replyType
 */
class NcrReply extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => ['operation_date'],
                    self::EVENT_BEFORE_UPDATE => ['operation_date'],
                ],
                'value' => function () {
                    return date('Y-m-d H:i:s');
                },
            ],
            [
                'class' => BlameableBehavior::class,
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['operation_name'],
                    BaseActiveRecord::EVENT_BEFORE_UPDATE => ['operation_name'],
                ],
            ],
        ];
    }

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
            [['ncr_id', 'reply_type_id', 'quantity', 'operation_name', 'approve_name'], 'integer'],
            [['proceed', 'docs'], 'string'],
            [['operation_date', 'approve_date'], 'safe'],
            [['unit'], 'string', 'max' => 45],
            [['ref'], 'string', 'max' => 255],
            // [['ncr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ncr::class, 'targetAttribute' => ['ncr_id' => 'id']],
            [['reply_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => NcrReplyType::class, 'targetAttribute' => ['reply_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ncr_id' => Yii::t('app', 'NCR'),
            'reply_type_id' => Yii::t('app', 'ประเภทการดำเนินการ'),
            'quantity' => Yii::t('app', 'จำนวน'),
            'unit' => Yii::t('app', 'หน่วย'),
            'proceed' => Yii::t('app', 'วิธีการ'),
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
}
