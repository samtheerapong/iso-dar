<?php

namespace app\modules\nfc\models;

use Yii;

/**
 * This is the model class for table "en_part_group".
 *
 * @property int $id
 * @property string|null $code รหัส
 * @property string|null $name ชื่อ
 * @property int|null $department_id แผนก
 * @property int|null $active สถานะ
 *
 * @property Department $department
 * @property EnPart[] $enParts
 */
class PartGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'en_part_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_id', 'active'], 'integer'],
            [['code', 'name'], 'string', 'max' => 45],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::class, 'targetAttribute' => ['department_id' => 'id']],
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
            'department_id' => Yii::t('app', 'แผนก'),
            'active' => Yii::t('app', 'สถานะ'),
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::class, ['id' => 'department_id']);
    }

    /**
     * Gets query for [[EnParts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnParts()
    {
        return $this->hasMany(Part::class, ['en_part_group_id' => 'id']);
    }
}
