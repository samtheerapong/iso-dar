<?php

namespace app\modules\ncr\models;

use Yii;

/**
 * This is the model class for table "ncr_protection".
 *
 * @property int $id
 * @property int|null $ncr_solving_id
 *
 * @property NcrSolving $ncrSolving
 */
class NcrProtection extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ncr_protection';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ncr_solving_id'], 'integer'],
            [['ncr_solving_id'], 'exist', 'skipOnError' => true, 'targetClass' => NcrSolving::class, 'targetAttribute' => ['ncr_solving_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ncr_solving_id' => Yii::t('app', 'Ncr Solving ID'),
        ];
    }

    /**
     * Gets query for [[NcrSolving]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNcrSolving()
    {
        return $this->hasOne(NcrSolving::class, ['id' => 'ncr_solving_id']);
    }
}
