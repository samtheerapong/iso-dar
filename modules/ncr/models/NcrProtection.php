<?php

namespace app\modules\ncr\models;

use app\models\User;
use Yii;

/**
 * This is the model class for table "ncr_protection".
 *
 * @property int $id
 * @property int|null $ncr_id NCR
 * @property int|null $ncr_cause_item การวิเคราะห์สาเหตุ
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
            [['ncr_id', 'operator'], 'integer'],
            [['issue', 'action'], 'string'],
            [['schedule_date', 'ncr_cause_item'], 'safe'],
            [['ncr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ncr::class, 'targetAttribute' => ['ncr_id' => 'id']],
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
            'ncr_cause_item' => Yii::t('app', 'การวิเคราะห์สาเหตุ'),
            'issue' => Yii::t('app', 'สาเหตุปัญหา'),
            'action' => Yii::t('app', 'การแก้ไขและป้องกัน'),
            'schedule_date' => Yii::t('app', 'กำหนดการแก้ไข'),
            'operator' => Yii::t('app', 'ผู้ดำเนินการ'),
        ];
    }


    public function getNcrs()
    {
        return $this->hasOne(Ncr::class, ['id' => 'ncr_id']);
    }

    public function getNcrCause()
    {
        return $this->hasOne(NcrCause::class, ['id' => 'ncr_cause_item']);
    }

    public function getProtectUser()
    {
        return $this->hasOne(User::class, ['id' => 'operator']);
    }

    //  ncr_cause_item setToArray
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!empty($this->ncr_cause_item)) {
                $this->ncr_cause_item = $this->setToArray($this->ncr_cause_item);
            }
            return true;
        } else {
            return false;
        }
    }

    public function setToArray($value)
    {
        return is_array($value) ? implode(',', $value) : NULL;
    }

    public function getOperator0()
    {
        return $this->hasOne(User::class, ['id' => 'operator']);
    }

    public function getArray($value)
    {
        return explode(',', $value);
    }
}
