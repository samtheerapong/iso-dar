<?php

namespace app\modules\engineer\models;

use Yii;

/**
 * This is the model class for table "en_machine".
 *
 * @property int $id
 * @property string|null $machine_code รหัสเครื่องจักร
 * @property string|null $machine_name ชื่อเครื่องจักร
 * @property string|null $last_repair วันที่ซ่อมล่าสุด
 *
 * @property Wo[] $enWos
 */
class Machine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'en_machine';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['last_repair'], 'safe'],
            [['machine_code', 'machine_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'machine_code' => Yii::t('app', 'รหัสเครื่องจักร'),
            'machine_name' => Yii::t('app', 'ชื่อเครื่องจักร'),
            'last_repair' => Yii::t('app', 'วันที่ซ่อมล่าสุด'),
        ];
    }

    /**
     * Gets query for [[EnWos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnWos()
    {
        return $this->hasMany(Wo::class, ['machine_id' => 'id']);
    }
}
