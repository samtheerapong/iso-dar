<?php

namespace app\modules\ncr\models;

use Yii;

/**
 * This is the model class for table "ncr_accept".
 *
 * @property int $id
 * @property int|null $ncr_id NCR
 * @property int|null $ncr_concession_id ยอมรับเป็นกรณีพิเศษ
 * @property string|null $customer_name ชื่อลูกค้า
 * @property string|null $process วิธีการ
 * @property string|null $cause เหตุผล
 * @property int|null $approve_name ผู้อนุมัติ
 * @property string|null $approve_date วันที่อนุมัติ
 *
 * @property Ncr $ncr
 * @property NcrClosing[] $ncrClosings
 * @property NcrConcession $ncrConcession
 */
class NcrAccept extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ncr_accept';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ncr_id', 'ncr_concession_id', 'approve_name'], 'integer'],
            [['approve_date'], 'safe'],
            [['customer_name', 'process', 'cause'], 'string', 'max' => 255],
            [['ncr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ncr::class, 'targetAttribute' => ['ncr_id' => 'id']],
            [['ncr_concession_id'], 'exist', 'skipOnError' => true, 'targetClass' => NcrConcession::class, 'targetAttribute' => ['ncr_concession_id' => 'id']],
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
            'ncr_concession_id' => Yii::t('app', 'ยอมรับเป็นกรณีพิเศษ'),
            'customer_name' => Yii::t('app', 'ชื่อลูกค้า'),
            'process' => Yii::t('app', 'วิธีการ'),
            'cause' => Yii::t('app', 'เหตุผล'),
            'approve_name' => Yii::t('app', 'ผู้อนุมัติ'),
            'approve_date' => Yii::t('app', 'วันที่อนุมัติ'),
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
     * Gets query for [[NcrClosings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNcrClosings()
    {
        return $this->hasMany(NcrClosing::class, ['ncr_accept_id' => 'id']);
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
}
