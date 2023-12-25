<?php

namespace app\modules\engineer\models;

use Yii;

/**
 * This is the model class for table "en_wo".
 *
 * @property int $id
 * @property int|null $rp_id รายการซ่อม
 * @property string|null $title เรื่อง
 * @property string|null $description รายละเอียด
 * @property string|null $work_code เลขที่ใบสั่งซ่อม
 * @property string|null $work_date วันที่
 * @property int|null $machine_id เครื่องจักร
 * @property string|null $location สถานที่
 * @property int|null $work_type_id ประเภทงาน
 * @property string|null $work_start วันที่เริ่มต้นซ่อม
 * @property string|null $work_end วันที่กำหนดเสร็จ
 * @property string|null $ref อ้างอิง
 * @property int|null $category_id ประเภทการส่งซ่อม
 * @property string|null $work_method วิธีการ
 * @property string|null $service_date วันที่บริการ
 * @property int|null $frequency ความถี่
 * @property string|null $remask
 *
 * @property Category $category
 * @property WoApprove[] $WoApproves
 * @property WoList[] $WoLists
 * @property Machine $machine
 * @property Rp $rp
 * @property WorkType $workType
 */
class Wo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'en_wo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rp_id', 'machine_id', 'work_type_id', 'category_id', 'frequency'], 'integer'],
            [['description', 'ref', 'work_method', 'remask'], 'string'],
            [['work_date', 'work_start', 'work_end', 'service_date'], 'safe'],
            [['title', 'location'], 'string', 'max' => 255],
            [['work_code'], 'string', 'max' => 45],
            [['machine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Machine::class, 'targetAttribute' => ['machine_id' => 'id']],
            [['rp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rp::class, 'targetAttribute' => ['rp_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['work_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => WorkType::class, 'targetAttribute' => ['work_type_id' => 'id']],
            [['workclass_id'], 'exist', 'skipOnError' => true, 'targetClass' => WorkClass::class, 'targetAttribute' => ['wo_workclass_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'rp_id' => Yii::t('app', 'รายการซ่อม'),
            'title' => Yii::t('app', 'เรื่อง'),
            'description' => Yii::t('app', 'รายละเอียด'),
            'work_code' => Yii::t('app', 'เลขที่ใบสั่งซ่อม'),
            'work_date' => Yii::t('app', 'วันที่'),
            'machine_id' => Yii::t('app', 'เครื่องจักร'),
            'location' => Yii::t('app', 'สถานที่'),
            'work_type_id' => Yii::t('app', 'ประเภทงาน'),
            'work_start' => Yii::t('app', 'วันที่เริ่มต้นซ่อม'),
            'work_end' => Yii::t('app', 'วันที่กำหนดเสร็จ'),
            'ref' => Yii::t('app', 'อ้างอิง'),
            'category_id' => Yii::t('app', 'ประเภทการส่งซ่อม'),
            'workclass_id' => Yii::t('app', 'รายละเอียดงาน'),
            'work_method' => Yii::t('app', 'วิธีการ'),
            'service_date' => Yii::t('app', 'วันที่บริการ'),
            'frequency' => Yii::t('app', 'ความถี่'),
            'remask' => Yii::t('app', 'Remask'),
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[WoApproves]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWoApproves()
    {
        return $this->hasMany(WoApprove::class, ['wo_id' => 'id']);
    }

    /**
     * Gets query for [[WoLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWoLists()
    {
        return $this->hasMany(WoList::class, ['workorder_id' => 'id']);
    }

    /**
     * Gets query for [[Machine]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMachine()
    {
        return $this->hasOne(Machine::class, ['id' => 'machine_id']);
    }

    /**
     * Gets query for [[Rp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRp()
    {
        return $this->hasOne(Rp::class, ['id' => 'rp_id']);
    }

    /**
     * Gets query for [[WorkType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkType()
    {
        return $this->hasOne(WorkType::class, ['id' => 'work_type_id']);
    }


    public function getWorkClass()
    {
        return $this->hasOne(WorkClass::class, ['id' => 'workclass_id']);
    }
}
