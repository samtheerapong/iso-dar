<?php

namespace app\modules\engineer\models;

use Yii;

/**
 * This is the model class for table "en_wo_list".
 *
 * @property int $id
 * @property int|null $workorder_id ใบสั่งซ่อม
 * @property string|null $working_date วันที่ปฎิบัติงาน
 * @property string|null $description รายละเอียดการปฎิบัติงาน
 * @property string|null $problem ปัญหาที่พบ
 * @property string|null $images รูปภาพ
 * @property int|null $lock_out ระบบล็อค
 * @property int|null $tag_out ป้ายทะเบียน
 * @property int|null $checker ผู้ตรวจสอบก่อนซ่อม
 * @property int|null $recheck_electric ตรวจไฟฟ้าหลังซ่อม
 * @property int|null $recheck_mechanics ตรวจเครื่องจักรหลังซ่อม
 * @property int|null $rechecker ผู้ตรวจสอบหลังซ่อม
 *
 * @property EnActor[] $enActors
 * @property EnWo $workorder
 */
class WoList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'en_wo_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['workorder_id', 'lock_out', 'tag_out', 'checker', 'recheck_electric', 'recheck_mechanics', 'rechecker'], 'integer'],
            [['working_date'], 'safe'],
            [['description', 'problem', 'images'], 'string'],
            [['workorder_id'], 'exist', 'skipOnError' => true, 'targetClass' => Wo::class, 'targetAttribute' => ['workorder_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'workorder_id' => Yii::t('app', 'ใบสั่งซ่อม'),
            'working_date' => Yii::t('app', 'วันที่ปฎิบัติงาน'),
            'description' => Yii::t('app', 'รายละเอียดการปฎิบัติงาน'),
            'problem' => Yii::t('app', 'ปัญหาที่พบ'),
            'images' => Yii::t('app', 'รูปภาพ'),
            'lock_out' => Yii::t('app', 'ระบบล็อค'),
            'tag_out' => Yii::t('app', 'ป้ายทะเบียน'),
            'checker' => Yii::t('app', 'ผู้ตรวจสอบก่อนซ่อม'),
            'recheck_electric' => Yii::t('app', 'ตรวจไฟฟ้าหลังซ่อม'),
            'recheck_mechanics' => Yii::t('app', 'ตรวจเครื่องจักรหลังซ่อม'),
            'rechecker' => Yii::t('app', 'ผู้ตรวจสอบหลังซ่อม'),
        ];
    }

    /**
     * Gets query for [[EnActors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnActors()
    {
        return $this->hasMany(Actor::class, ['en_wo_list_id' => 'id']);
    }

    /**
     * Gets query for [[Workorder]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkorder()
    {
        return $this->hasOne(Wo::class, ['id' => 'workorder_id']);
    }
}
