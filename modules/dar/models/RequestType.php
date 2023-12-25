<?php

namespace app\modules\dar\models;

use Yii;

/**
 * This is the model class for table "request_type".
 *
 * @property int $id
 * @property string|null $code รหัส
 * @property string|null $name ชื่อ
 * @property string|null $color สี
 * @property int|null $active สถานะ
 *
 * @property Request[] $requests
 */
class RequestType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request_type';
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
            'name' => Yii::t('app', 'ชื่อ'),
            'color' => Yii::t('app', 'สี'),
            'active' => Yii::t('app', 'สถานะ'),
        ];
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::class, ['request_type_id' => 'id']);
    }
}
