<?php

namespace app\modules\nfc\models;

use app\modules\engineer\models\Upload;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "en_part".
 *
 * @property int $id
 * @property string|null $photo รูปภาพ
 * @property string|null $code รหัส
 * @property string|null $name ชื่อ
 * @property string|null $name_en ชื่อภาษาอังกฤษ
 * @property string|null $old_code รหัสเก่า
 * @property string|null $description
 * @property int $en_part_doc_id รหัสเอกสาร
 * @property int|null $en_part_group_id รหัสกลุ่ม
 * @property int|null $en_part_type_id รหัสประเภท
 * @property int|null $unit_lg หน่วยนับใหญ่
 * @property int|null $unit_sm หน่วยนับเล็ก
 * @property string|null $serial_no ซีเรียวนัมเบอร์
 * @property string|null $price
 * @property int|null $cost ราคา
 * @property int|null $active เปิดใช้งาน
 * @property string|null $last_date วันที่ล่าสุด
 * @property string|null $remask
 * @property int|null $imported
 * @property int|null $status สถานะ
 *
 * @property PartDoc $enPartDoc
 * @property PartGroup $enPartGroup
 * @property PartType $enPartType
 * @property Unit $unitLg
 * @property Unit $unitSm
 */
class Part extends \yii\db\ActiveRecord
{

    public $upload_foler = 'uploads/part';


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'en_part';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'remask'], 'string'],
            [['en_part_doc_id'], 'required'],
            [['en_part_doc_id', 'en_part_group_id', 'en_part_type_id', 'unit_lg', 'unit_sm', 'cost', 'active', 'imported', 'status'], 'integer'],
            [['last_date'], 'safe'],
            [['code', 'old_code', 'serial_no', 'price', 'ref'], 'string', 'max' => 45],
            [['name', 'name_en'], 'string', 'max' => 255],
            [['en_part_doc_id'], 'exist', 'skipOnError' => true, 'targetClass' => PartDoc::class, 'targetAttribute' => ['en_part_doc_id' => 'id']],
            [['en_part_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => PartGroup::class, 'targetAttribute' => ['en_part_group_id' => 'id']],
            [['en_part_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PartType::class, 'targetAttribute' => ['en_part_type_id' => 'id']],
            [['unit_lg'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::class, 'targetAttribute' => ['unit_lg' => 'id']],
            [['unit_sm'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::class, 'targetAttribute' => ['unit_sm' => 'id']],
            [['ref'], 'unique'],
            [['photo'], 'file', 'skipOnEmpty' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'photo' => Yii::t('app', 'รูปภาพ'),
            'code' => Yii::t('app', 'รหัส'),
            'name' => Yii::t('app', 'ชื่อ'),
            'name_en' => Yii::t('app', 'ชื่อภาษาอังกฤษ'),
            'old_code' => Yii::t('app', 'รหัสเก่า'),
            'description' => Yii::t('app', 'รายละเอียด'),
            'en_part_doc_id' => Yii::t('app', 'รหัสเอกสาร'),
            'en_part_group_id' => Yii::t('app', 'รหัสกลุ่ม'),
            'en_part_type_id' => Yii::t('app', 'รหัสประเภท'),
            'unit_lg' => Yii::t('app', 'หน่วยนับใหญ่'),
            'unit_sm' => Yii::t('app', 'หน่วยนับเล็ก'),
            'serial_no' => Yii::t('app', 'ซีเรียวนัมเบอร์'),
            'price' => Yii::t('app', 'ราคา'),
            'cost' => Yii::t('app', 'ค่าใช้จ่าย'),
            'active' => Yii::t('app', 'เปิดใช้งาน'),
            'last_date' => Yii::t('app', 'วันที่ล่าสุด'),
            'remask' => Yii::t('app', 'หมายเหตุ'),
            'imported' => Yii::t('app', 'การนำเข้า'),
            'status' => Yii::t('app', 'สถานะ'),
            'ref' => Yii::t('app', 'ref'),
        ];
    }

    /**
     * Gets query for [[EnPartDoc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPartDoc()
    {
        return $this->hasOne(PartDoc::class, ['id' => 'en_part_doc_id']);
    }

    /**
     * Gets query for [[EnPartGroup]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPartGroup()
    {
        return $this->hasOne(PartGroup::class, ['id' => 'en_part_group_id']);
    }

    /**
     * Gets query for [[EnPartType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPartType()
    {
        return $this->hasOne(PartType::class, ['id' => 'en_part_type_id']);
    }

    /**
     * Gets query for [[UnitLg]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnitLg()
    {
        return $this->hasOne(Unit::class, ['id' => 'unit_lg']);
    }

    /**
     * Gets query for [[UnitSm]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnitSm()
    {
        return $this->hasOne(Unit::class, ['id' => 'unit_sm']);
    }


    // ----------------- Uploads ----------------- //
    public function upload($model, $attribute)
    {
        $photo  = UploadedFile::getInstance($model, $attribute);
        $path = $this->getUploadPath();
        if ($this->validate() && $photo !== null) {

            $fileName = md5($photo->baseName . time()) . '.' . $photo->extension;
            if ($photo->saveAs($path . $fileName)) {
                return $fileName;
            }
        }
        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }

    public function getUploadPath()
    {
        return Yii::getAlias('@webroot') . '/' . $this->upload_foler . '/';
    }

    public function getUploadUrl()
    {
        return Yii::getAlias('@web') . '/' . $this->upload_foler . '/';
    }

    public function getPhotoViewer()
    {
        return empty($this->photo) ? Yii::getAlias('@web') . '/images/no-img.png' : $this->getUploadUrl() . $this->photo;
    }
}
