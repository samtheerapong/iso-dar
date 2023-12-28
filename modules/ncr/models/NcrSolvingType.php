<?php

namespace app\modules\ncr\models;

use Yii;

/**
 * This is the model class for table "ncr_solving_type".
 *
 * @property int $id
 * @property string|null $type_name ประเภท
 * @property string|null $color สี
 * @property int|null $active สถานะ
 *
 * @property NcrSolving[] $ncrSolvings
 */
class NcrSolvingType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ncr_solving_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['type_name'], 'string', 'max' => 100],
            [['color'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type_name' => Yii::t('app', 'ประเภท'),
            'color' => Yii::t('app', 'สี'),
            'active' => Yii::t('app', 'สถานะ'),
        ];
    }

    /**
     * Gets query for [[NcrSolvings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNcrSolvings()
    {
        return $this->hasMany(NcrSolving::class, ['solving_type_id' => 'id']);
    }
}
