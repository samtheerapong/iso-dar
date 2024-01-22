<?php

namespace app\modules\ncr\models;

use app\models\User;
use Yii;

/**
 * This is the model class for table "ncr_solving".
 *
 * @property int $id
 * @property int|null $ncr_id เลขที่ NCR
 * @property int|null $solving_type_id ประเภทการดำเนินการ
 * @property int|null $quantity จำนวน
 * @property string|null $unit หน่วย
 * @property string|null $proceed วิธีการ
 * @property string|null $operation_date วันที่ดำเนินการ
 * @property int|null $operation_name ผู้ดำเนินการ
 * @property int|null $ncr_concession_id ยอมรับเป็นกรณีพิเศษ
 * @property int|null $customer_name ชื่อลูกค้า
 * @property string|null $process วิธีการ
 * @property string|null $cause เหตุผล
 * @property int|null $approve_name ผู้อนุมัติ
 * @property string|null $approve_date วันที่อนุมัติ
 * @property string|null $docs แนบไฟล์
 * @property string|null $ref Ref
 *
 * @property Ncr $ncr
 * @property NcrConcession $ncrConcession
 * @property NcrProtection[] $ncrProtections
 * @property NcrSolvingType $solvingType
 */
class NcrSolving extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ncr_solving';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ncr_id', 'solving_type_id', 'quantity', 'operation_name', 'ncr_concession_id', 'approve_name'], 'integer'],
            [['proceed'], 'string'],
            [['operation_date', 'approve_date'], 'safe'],
            [['unit'], 'string', 'max' => 45],
            [['process', 'cause', 'ref', 'customer_name'], 'string', 'max' => 255],
            [['ncr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ncr::class, 'targetAttribute' => ['ncr_id' => 'id']],
            [['ncr_concession_id'], 'exist', 'skipOnError' => true, 'targetClass' => NcrConcession::class, 'targetAttribute' => ['ncr_concession_id' => 'id']],
            [['solving_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => NcrSolvingType::class, 'targetAttribute' => ['solving_type_id' => 'id']],
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
            'ncr_id' => Yii::t('app', 'เลขที่ NCR'),
            'solving_type_id' => Yii::t('app', 'ประเภทการดำเนินการ'),
            'quantity' => Yii::t('app', 'จำนวน'),
            'unit' => Yii::t('app', 'หน่วย'),
            'proceed' => Yii::t('app', 'วิธีการ'),
            'operation_date' => Yii::t('app', 'วันที่ดำเนินการ'),
            'operation_name' => Yii::t('app', 'ผู้ดำเนินการ'),
            'ncr_concession_id' => Yii::t('app', 'ยอมรับเป็นกรณีพิเศษ'),
            'customer_name' => Yii::t('app', 'ชื่อลูกค้า'),
            'process' => Yii::t('app', 'วิธีการ'),
            'cause' => Yii::t('app', 'เหตุผล'),
            'approve_name' => Yii::t('app', 'ผู้อนุมัติ'),
            'approve_date' => Yii::t('app', 'วันที่อนุมัติ'),
            'docs' => Yii::t('app', 'แนบไฟล์'),
            'ref' => Yii::t('app', 'Ref'),
        ];
    }

    /**
     * Gets query for [[Ncr]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNcr()
    {
        return $this->hasOne(Ncr::class, ['id' => 'ncr_id']);
    }

    /**
     * Gets query for [[NcrConcession]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNcrConcession()
    {
        return $this->hasOne(NcrConcession::class, ['id' => 'ncr_concession_id']);
    }

    /**
     * Gets query for [[NcrProtections]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNcrProtections()
    {
        return $this->hasMany(NcrProtection::class, ['ncr_solving_id' => 'id']);
    }

    /**
     * Gets query for [[SolvingType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSolvingType()
    {
        return $this->hasOne(NcrSolvingType::class, ['id' => 'solving_type_id']);
    }

    public function getOperationBy()
    {
        return $this->hasOne(User::class, ['id' => 'operation_name']);
    }

    public function getApproveBy()
    {
        return $this->hasOne(User::class, ['id' => 'approve_name']);
    }
}
