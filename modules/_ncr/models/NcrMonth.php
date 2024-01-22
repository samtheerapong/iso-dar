<?php

namespace app\modules\ncr\models;

use Yii;

/**
 * This is the model class for table "ncr_month".
 *
 * @property int $id
 * @property string|null $month เดือน
 * @property string|null $color สี
 * @property int|null $active สถานะ
 *
 * @property Ncr[] $ncrs
 */
class NcrMonth extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ncr_month';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['month'], 'string', 'max' => 255],
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
            'month' => Yii::t('app', 'เดือน'),
            'color' => Yii::t('app', 'สี'),
            'active' => Yii::t('app', 'สถานะ'),
        ];
    }

    /**
     * Gets query for [[Ncrs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNcrs()
    {
        return $this->hasMany(Ncr::class, ['month' => 'id']);
    }
}
