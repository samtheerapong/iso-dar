<?php

namespace app\modules\engineer\models;

use Yii;

/**
 * This is the model class for table "en_actor".
 *
 * @property int $id
 * @property int|null $en_wo_list_id รายการซ่อม
 * @property int|null $technician_id ผู้ปฎิบัติงาน
 *
 * @property WoList $enWoList
 * @property Technician $technician
 */
class Actor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'en_actor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['en_wo_list_id', 'technician_id'], 'integer'],
            [['technician_id'], 'exist', 'skipOnError' => true, 'targetClass' => Technician::class, 'targetAttribute' => ['technician_id' => 'id']],
            [['en_wo_list_id'], 'exist', 'skipOnError' => true, 'targetClass' => WoList::class, 'targetAttribute' => ['en_wo_list_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'en_wo_list_id' => Yii::t('app', 'รายการซ่อม'),
            'technician_id' => Yii::t('app', 'ผู้ปฎิบัติงาน'),
        ];
    }

    /**
     * Gets query for [[EnWoList]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnWoList()
    {
        return $this->hasOne(WoList::class, ['id' => 'en_wo_list_id']);
    }

    /**
     * Gets query for [[Technician]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTechnician()
    {
        return $this->hasOne(Technician::class, ['id' => 'technician_id']);
    }
}
