<?php

namespace app\modules\ncr\models;

use Yii;

/**
 * This is the model class for table "ncr_process".
 *
 * @property int $id
 * @property string|null $name กระบวนการ
 * @property string|null $color สี
 * @property int|null $active สถานะ
 *
 * @property Ncr[] $ncrs
 */
class NcrProcess extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ncr_process';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'name' => Yii::t('app', 'กระบวนการ'),
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
        return $this->hasMany(Ncr::class, ['ncr_process_id' => 'id']);
    }
}
