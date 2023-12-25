<?php

namespace app\modules\nfc\models;

use Yii;

/**
 * This is the model class for table "en_unit".
 *
 * @property int $id
 * @property string|null $code รหัส
 * @property string|null $name ชื่อ
 * @property int|null $active สถานะ
 *
 * @property EnPart[] $enParts
 * @property EnPart[] $enParts0
 */
class Unit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'en_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['code'], 'string', 'max' => 45],
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
            'active' => Yii::t('app', 'สถานะ'),
        ];
    }

    /**
     * Gets query for [[EnParts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPartLg()
    {
        return $this->hasMany(Part::class, ['unit_lg' => 'id']);
    }

    /**
     * Gets query for [[EnParts0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPartSm()
    {
        return $this->hasMany(Part::class, ['unit_sm' => 'id']);
    }
}
