<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_rules".
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $name
 * @property string|null $color
 * @property int|null $active
 */
class UserRules extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_rules';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['code', 'name', 'color'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'color' => Yii::t('app', 'Color'),
            'active' => Yii::t('app', 'Active'),
        ];
    }
}
