<?php

namespace app\modules\nfc\models;

use app\modules\nfc\models\Department;
use Yii;

/**
 * This is the model class for table "en_warehouse".
 *
 * @property int $id
 * @property string|null $code รหัส
 * @property string|null $name ชื่อ
 * @property int|null $lot ล็อต
 * @property string|null $color สี
 * @property int|null $active สถานะ
 *
 * @property Department[] $departments
 */
class Warehouse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'en_warehouse';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lot', 'active'], 'integer'],
            [['code', 'color'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'รหัส'),
            'name' => Yii::t('app', 'ชื่อ'),
            'lot' => Yii::t('app', 'ล็อต'),
            'color' => Yii::t('app', 'สี'),
            'active' => Yii::t('app', 'สถานะ'),
        ];
    }

    /**
     * Gets query for [[Departments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Department::class, ['warehouse_id' => 'id']);
    }
}
