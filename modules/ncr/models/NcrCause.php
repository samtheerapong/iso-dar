<?php

namespace app\modules\ncr\models;

use Yii;

/**
 * This is the model class for table "ncr_cause".
 *
 * @property int $id
 * @property string|null $name ชื่อ
 * @property string|null $color สี
 * @property int|null $active สถานะ
 *
 * @property NcrProtection[] $ncrProtections
 */
class NcrCause extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ncr_cause';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['name'], 'string', 'max' => 100],
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
            'name' => Yii::t('app', 'ชื่อ'),
            'color' => Yii::t('app', 'สี'),
            'active' => Yii::t('app', 'สถานะ'),
        ];
    }

    /**
     * Gets query for [[NcrProtections]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNcrProtections()
    {
        return $this->hasMany(NcrProtection::class, ['ncr_cause_id' => 'id']);
    }
}
