<?php

namespace app\modules\ncr\models;

use Yii;

/**
 * This is the model class for table "ncr_closing".
 *
 * @property int $id
 * @property int|null $ncr_accept_id
 * @property int|null $accept การยอมรับ
 * @property int|null $auditor ผู้ตรวจติดตาม
 * @property int|null $qmr ผู้อนุมัติปิดการตรวจติดตาม
 * @property string|null $accept_date วันที่
 * @property string|null $ncr_closingcol
 *
 * @property NcrAccept $ncrAccept
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
            [['ncr_accept_id', 'accept', 'auditor', 'qmr'], 'integer'],
            [['accept_date'], 'safe'],
            [['ncr_closingcol'], 'string', 'max' => 45],
            [['ncr_accept_id'], 'exist', 'skipOnError' => true, 'targetClass' => NcrAccept::class, 'targetAttribute' => ['ncr_accept_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ncr_accept_id' => Yii::t('app', 'Ncr Accept ID'),
            'accept' => Yii::t('app', 'การยอมรับ'),
            'auditor' => Yii::t('app', 'ผู้ตรวจติดตาม'),
            'qmr' => Yii::t('app', 'ผู้อนุมัติปิดการตรวจติดตาม'),
            'accept_date' => Yii::t('app', 'วันที่'),
            'ncr_closingcol' => Yii::t('app', 'Ncr Closingcol'),
        ];
    }

    /**
     * Gets query for [[NcrAccept]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNcrAccept()
    {
        return $this->hasOne(NcrAccept::class, ['id' => 'ncr_accept_id']);
    }
}
