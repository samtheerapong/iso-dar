<?php

namespace app\modules\ncr\models;

use Yii;

/**
 * This is the model class for table "ncr_concession".
 *
 * @property int $id
 * @property string|null $concession_name การยอมรับ
 * @property string|null $color สี
 * @property int|null $active สถานะ
 *
 * @property NcrSolving[] $ncrSolvings
 */
class NcrConcession extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ncr_concession';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['concession_name'], 'string', 'max' => 100],
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
            'concession_name' => Yii::t('app', 'การยอมรับ'),
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
        return $this->hasMany(NcrSolving::class, ['ncr_concession_id' => 'id']);
    }
}
