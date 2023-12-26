<?php

namespace app\modules\ncr\models;

use Yii;

/**
 * This is the model class for table "ncr".
 *
 * @property int $id
 * @property string|null $ncr_number เลขที่ NCR
 * @property string|null $created_date วันที่
 * @property int|null $month เดือน
 * @property int|null $year ปี
 * @property int|null $department ถึงแผนก
 * @property int|null $ncr_process_id กระบวนการ
 * @property string|null $lot หมายเลขล็อต
 * @property string|null $production_date วันที่ผลิต
 * @property string|null $product_name ชื่อสินค้า
 * @property string|null $customer_name ชื่อลูกค้า
 * @property int|null $category_id หมวดหมู่
 * @property int|null $sub_category_id หมวดหมู่ย่อย
 * @property string|null $datail รายละเอียดปัญหา
 * @property int|null $department_issue แผนกที่พบปัญหา
 * @property int|null $report_by ผู้รายงาน
 * @property string|null $troubleshooting การดำเนินการ
 * @property string|null $docs ไฟล์แนบ
 * @property int|null $ncr_status_id สถานะ
 * @property string|null $ref อ้างอิง
 * @property string|null $created_at สร้างเมื่อ
 * @property int|null $created_by สร้างโดย
 * @property string|null $updated_at ล่าสุดเมื่อ
 * @property int|null $updated_by ล่าสุดโดย
 *
 * @property NcrCategory $category
 * @property NcrDepartment $departmentIssue
 * @property NcrDepartment $departmentIssue0
 * @property NcrMonth $month0
 * @property NcrProcess $ncrProcess
 * @property NcrSolving[] $ncrSolvings
 * @property NcrStatus $ncrStatus
 * @property NcrSubCategory $subCategory
 * @property NcrYear $year0
 */
class Ncr extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ncr';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_date', 'production_date', 'created_at', 'updated_at'], 'safe'],
            [['month', 'year', 'department', 'ncr_process_id', 'category_id', 'sub_category_id', 'department_issue', 'report_by', 'ncr_status_id', 'created_by', 'updated_by'], 'integer'],
            [['datail', 'troubleshooting', 'docs'], 'string'],
            [['ncr_number'], 'string', 'max' => 100],
            [['lot', 'product_name', 'customer_name'], 'string', 'max' => 255],
            [['ref'], 'string', 'max' => 45],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => NcrCategory::class, 'targetAttribute' => ['category_id' => 'id']],
            [['department_issue'], 'exist', 'skipOnError' => true, 'targetClass' => NcrDepartment::class, 'targetAttribute' => ['department_issue' => 'id']],
            [['department_issue'], 'exist', 'skipOnError' => true, 'targetClass' => NcrDepartment::class, 'targetAttribute' => ['department_issue' => 'id']],
            [['month'], 'exist', 'skipOnError' => true, 'targetClass' => NcrMonth::class, 'targetAttribute' => ['month' => 'id']],
            [['ncr_process_id'], 'exist', 'skipOnError' => true, 'targetClass' => NcrProcess::class, 'targetAttribute' => ['ncr_process_id' => 'id']],
            [['ncr_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => NcrStatus::class, 'targetAttribute' => ['ncr_status_id' => 'id']],
            [['sub_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => NcrSubCategory::class, 'targetAttribute' => ['sub_category_id' => 'id']],
            [['year'], 'exist', 'skipOnError' => true, 'targetClass' => NcrYear::class, 'targetAttribute' => ['year' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ncr_number' => Yii::t('app', 'เลขที่ NCR'),
            'created_date' => Yii::t('app', 'วันที่'),
            'month' => Yii::t('app', 'เดือน'),
            'year' => Yii::t('app', 'ปี'),
            'department' => Yii::t('app', 'ถึงแผนก'),
            'ncr_process_id' => Yii::t('app', 'กระบวนการ'),
            'lot' => Yii::t('app', 'หมายเลขล็อต'),
            'production_date' => Yii::t('app', 'วันที่ผลิต'),
            'product_name' => Yii::t('app', 'ชื่อสินค้า'),
            'customer_name' => Yii::t('app', 'ชื่อลูกค้า'),
            'category_id' => Yii::t('app', 'หมวดหมู่'),
            'sub_category_id' => Yii::t('app', 'หมวดหมู่ย่อย'),
            'datail' => Yii::t('app', 'รายละเอียดปัญหา'),
            'department_issue' => Yii::t('app', 'แผนกที่พบปัญหา'),
            'report_by' => Yii::t('app', 'ผู้รายงาน'),
            'troubleshooting' => Yii::t('app', 'การดำเนินการ'),
            'docs' => Yii::t('app', 'ไฟล์แนบ'),
            'ncr_status_id' => Yii::t('app', 'สถานะ'),
            'ref' => Yii::t('app', 'อ้างอิง'),
            'created_at' => Yii::t('app', 'สร้างเมื่อ'),
            'created_by' => Yii::t('app', 'สร้างโดย'),
            'updated_at' => Yii::t('app', 'ล่าสุดเมื่อ'),
            'updated_by' => Yii::t('app', 'ล่าสุดโดย'),
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(NcrCategory::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[DepartmentIssue]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getToDepartment()
    {
        return $this->hasOne(NcrDepartment::class, ['id' => 'department']);
    }

    /**
     * Gets query for [[DepartmentIssue0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartmentIssue0()
    {
        return $this->hasOne(NcrDepartment::class, ['id' => 'department_issue']);
    }

    /**
     * Gets query for [[Month0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMonth0()
    {
        return $this->hasOne(NcrMonth::class, ['id' => 'month']);
    }

    /**
     * Gets query for [[NcrProcess]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNcrProcess()
    {
        return $this->hasOne(NcrProcess::class, ['id' => 'ncr_process_id']);
    }

    /**
     * Gets query for [[NcrSolvings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNcrSolvings()
    {
        return $this->hasMany(NcrSolving::class, ['ncr_id' => 'id']);
    }

    /**
     * Gets query for [[NcrStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNcrStatus()
    {
        return $this->hasOne(NcrStatus::class, ['id' => 'ncr_status_id']);
    }

    /**
     * Gets query for [[SubCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategory()
    {
        return $this->hasOne(NcrSubCategory::class, ['id' => 'sub_category_id']);
    }

    /**
     * Gets query for [[Year0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getYear0()
    {
        return $this->hasOne(NcrYear::class, ['id' => 'year']);
    }
}