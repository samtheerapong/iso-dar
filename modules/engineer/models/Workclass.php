<?php

namespace app\modules\engineer\models;

use Yii;

/**
 * This is the model class for table "en_workclass".
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $name
 * @property int|null $active
 */
class Workclass extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'en_workclass';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['code', 'name'], 'string', 'max' => 45],
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
            'active' => Yii::t('app', 'Active'),
        ];
    }
}
