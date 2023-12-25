<?php

namespace app\modules\engineer\models;

use Yii;

/**
 * This is the model class for table "en_work_type".
 *
 * @property int $id
 * @property string $code รหัส
 * @property string $name ชื่อ
 * @property string|null $detail รายละเอียด
 * @property string|null $color สี
 * @property int|null $active สถานะ
 *
 * @property Wo[] $enWos
 */
class WorkType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'en_work_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['detail'], 'string'],
            [['active'], 'integer'],
            [['code', 'name', 'color'], 'string', 'max' => 255],
            [['code'], 'unique'],
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
            'detail' => Yii::t('app', 'รายละเอียด'),
            'color' => Yii::t('app', 'สี'),
            'active' => Yii::t('app', 'สถานะ'),
        ];
    }

    /**
     * Gets query for [[EnWos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnWos()
    {
        return $this->hasMany(Wo::class, ['work_type_id' => 'id']);
    }
}
