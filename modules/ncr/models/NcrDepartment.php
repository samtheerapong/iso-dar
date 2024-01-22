<?php

namespace app\modules\ncr\models;

use Yii;

/**
 * This is the model class for table "ncr_department".
 *
 * @property int $id
 * @property string|null $code รหัส
 * @property string|null $name แผนก
 * @property string|null $color สี
 * @property int|null $active สถานะ
 *
 * @property Ncr[] $ncrs
 * @property Ncr[] $ncrs0
 */
class NcrDepartment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ncr_department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['code', 'color'], 'string', 'max' => 45],
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
            'name' => Yii::t('app', 'แผนก'),
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
        return $this->hasMany(Ncr::class, ['department_issue' => 'id']);
    }

    /**
     * Gets query for [[Ncrs0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNcrs0()
    {
        return $this->hasMany(Ncr::class, ['department_issue' => 'id']);
    }
}
