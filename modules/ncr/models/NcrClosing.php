<?php

namespace app\modules\ncr\models;

use Yii;

/**
 * This is the model class for table "ncr_closing".
 *
 * @property int $id
 * @property int|null $ncr_id NCR
 * @property int|null $accept การยอมรับ
 * @property int|null $auditor ผู้ตรวจติดตาม
 * @property int|null $qmr ผู้อนุมัติปิดการตรวจติดตาม
 * @property string|null $accept_date วันที่
 * @property string|null $ncr_closingcol
 *
 * @property Ncr $ncr
 */
class NcrClosing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ncr_closing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ncr_id', 'accept', 'auditor', 'qmr'], 'integer'],
            [['accept_date'], 'safe'],
            [['ncr_closingcol'], 'string', 'max' => 45],
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
            'accept' => Yii::t('app', 'การยอมรับ'),
            'auditor' => Yii::t('app', 'ผู้ตรวจติดตาม'),
            'qmr' => Yii::t('app', 'ผู้อนุมัติปิดการตรวจติดตาม'),
            'accept_date' => Yii::t('app', 'วันที่'),
            'ncr_closingcol' => Yii::t('app', 'Ncr Closingcol'),
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
}
