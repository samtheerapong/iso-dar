<?php

namespace app\modules\nfc\models;

use Yii;

/**
 * This is the model class for table "uploads".
 *
 * @property int $id
 * @property int|null $ref
 * @property string|null $file_name
 * @property string|null $real_filename
 * @property string|null $created_at
 */
class Uploads extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uploads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['file_name', 'real_filename','ref'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ref' => Yii::t('app', 'Ref'),
            'file_name' => Yii::t('app', 'File Name'),
            'real_filename' => Yii::t('app', 'Real Filename'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
