<?php

namespace app\modules\ncr\models;

use app\models\User;
use Yii;

class NcrClosing extends \yii\db\ActiveRecord
{
  
    public static function tableName()
    {
        return 'ncr_closing';
    }

    public function rules()
    {
        return [
            [['ncr_id', 'accept', 'auditor', 'qmr'], 'integer'],
            [['accept_date'], 'safe'],
            [['ncr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ncr::class, 'targetAttribute' => ['ncr_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ncr_id' => Yii::t('app', 'NCR'),
            'accept' => Yii::t('app', 'การยอมรับ'),
            'auditor' => Yii::t('app', 'ผู้ตรวจติดตาม'),
            'qmr' => Yii::t('app', 'ผู้อนุมัติปิดการตรวจติดตาม'),
            'accept_date' => Yii::t('app', 'วันที่'),
        ];
    }

    public function getNcrs()
    {
        return $this->hasOne(Ncr::class, ['id' => 'ncr_id']);
    }
    public function getQmrApprove()
    {
        return $this->hasOne(User::class, ['id' => 'qmr']);
    }
    public function getAuditApprove()
    {
        return $this->hasOne(User::class, ['id' => 'auditor']);
    }

    public function getArray($value)
    {
        return explode(',', $value);
    }
}
