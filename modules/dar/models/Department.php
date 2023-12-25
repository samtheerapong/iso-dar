<?php

namespace app\modules\dar\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property int $id
 * @property string|null $code รหัส
 * @property string|null $name ชื่อแผนก
 * @property string|null $detail รายละเอียด
 * @property int|null $department_head หัวหน้าแผนก
 * @property string|null $color สี
 * @property int|null $active สถานะ
 *
 * @property Request[] $requests
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['detail'], 'string'],
            [['department_head', 'active'], 'integer'],
            [['code', 'name', 'color'], 'string', 'max' => 255],
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
            'name' => Yii::t('app', 'ชื่อแผนก'),
            'detail' => Yii::t('app', 'รายละเอียด'),
            'department_head' => Yii::t('app', 'หัวหน้าแผนก'),
            'color' => Yii::t('app', 'สี'),
            'active' => Yii::t('app', 'สถานะ'),
        ];
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::class, ['department_id' => 'id']);
    }
}
