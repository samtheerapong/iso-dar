<?php

namespace app\modules\ncr\models;

use Yii;

/**
 * This is the model class for table "ncr_status".
 *
 * @property int $id
 * @property string|null $status_name
 * @property string|null $color
 * @property int|null $avtive
 *
 * @property Ncr[] $ncrs
 */
class NcrStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ncr_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['avtive'], 'integer'],
            [['status_name'], 'string', 'max' => 100],
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
            'status_name' => Yii::t('app', 'Status Name'),
            'color' => Yii::t('app', 'Color'),
            'avtive' => Yii::t('app', 'Avtive'),
        ];
    }

    /**
     * Gets query for [[Ncrs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNcrs()
    {
        return $this->hasMany(Ncr::class, ['ncr_status_id' => 'id']);
    }
}
