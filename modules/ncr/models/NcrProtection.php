<?php

namespace app\modules\ncr\models;

use Yii;

/**
 * This is the model class for table "ncr_protection".
 *
 * @property int $id
 * @property int|null $ncr_id NCR
 * @property int|null $ncr_cause_id การวิเคราะห์สาเหตุ
 * @property string|null $issue สาเหตุปัญหา
 * @property string|null $action การแก้ไขและป้องกัน
 * @property string|null $schedule_date กำหนดการแก้ไข
 * @property int|null $operator ผู้ดำเนินการ
 *
 * @property Ncr $ncr
 * @property NcrCause $ncrCause
 */
class NcrProtection extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ncr_protection';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ncr_id', 'ncr_cause_id', 'operator'], 'integer'],
            [['issue', 'action'], 'string'],
            [['schedule_date'], 'safe'],
            [['ncr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ncr::class, 'targetAttribute' => ['ncr_id' => 'id']],
            [['ncr_cause_id'], 'exist', 'skipOnError' => true, 'targetClass' => NcrCause::class, 'targetAttribute' => ['ncr_cause_id' => 'id']],
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
            'ncr_cause_id' => Yii::t('app', 'การวิเคราะห์สาเหตุ'),
            'issue' => Yii::t('app', 'สาเหตุปัญหา'),
            'action' => Yii::t('app', 'การแก้ไขและป้องกัน'),
            'schedule_date' => Yii::t('app', 'กำหนดการแก้ไข'),
            'operator' => Yii::t('app', 'ผู้ดำเนินการ'),
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
     * Gets query for [[NcrCause]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNcrCause()
    {
        return $this->hasOne(NcrCause::class, ['id' => 'ncr_cause_id']);
    }
}
