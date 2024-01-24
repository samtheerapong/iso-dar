<?php

namespace app\modules\ncr\models;

use app\models\User;
use Yii;

class NcrReply extends \yii\db\ActiveRecord
{
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
            [['ncr_id', 'reply_type_id', 'quantity'], 'integer'],
            [['method', 'docs'], 'string'],
            [['operation_date', 'approve_date', 'operation_name', 'approve_name'], 'safe'],
            [['unit'], 'string', 'max' => 45],
            [['ref'], 'string', 'max' => 255],
            [['reply_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => NcrReplyType::class, 'targetAttribute' => ['reply_type_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ncr_id' => Yii::t('app', 'NCR'),
            'reply_type_id' => Yii::t('app', 'ประเภทการดำเนินการ'),
            'quantity' => Yii::t('app', 'จำนวน'),
            'unit' => Yii::t('app', 'หน่วย'),
            'method' => Yii::t('app', 'วิธีการ'),
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

    public function getApprover()
    {
        return $this->hasOne(User::class, ['id' => 'approve_name']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!empty($this->process)) {
                $this->process = $this->setToArray($this->process);
            }
            return true;
        } else {
            return false;
        }
    }

    public function getArray($value)
    {
        return explode(',', $value);
    }

    public function setToArray($value)
    {
        return is_array($value) ? implode(',', $value) : NULL;
    }
   
}
