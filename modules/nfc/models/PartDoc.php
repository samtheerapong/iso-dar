<?php

namespace app\modules\nfc\models;

use Yii;

/**
 * This is the model class for table "en_part_doc".
 *
 * @property int $id
 * @property string|null $code รหัส
 * @property string|null $name ชื่อ
 * @property int|null $active สถานะ
 *
 * @property EnPart[] $enParts
 */
class PartDoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'en_part_doc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
            [['active'], 'integer'],
            [['code'], 'string', 'max' => 45],
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
    public function getEnParts()
    {
        return $this->hasMany(Part::class, ['en_part_doc_id' => 'id']);
    }
}
