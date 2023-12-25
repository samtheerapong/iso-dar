<?php

namespace app\modules\dar\models;

use Yii;

/**
 * This is the model class for table "request_upload".
 *
 * @property int $id
 * @property int|null $request_id
 * @property string|null $ref
 * @property string|null $file_name
 * @property string|null $real_filename
 * @property string|null $create_date
 * @property int|null $active
 *
 * @property Request $request
 */
class RequestUpload extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request_upload';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['request_id', 'active'], 'integer'],
            [['create_date'], 'safe'],
            [['ref', 'file_name', 'real_filename'], 'string', 'max' => 255],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::class, 'targetAttribute' => ['request_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'request_id' => Yii::t('app', 'Request ID'),
            'ref' => Yii::t('app', 'Ref'),
            'file_name' => Yii::t('app', 'File Name'),
            'real_filename' => Yii::t('app', 'Real Filename'),
            'create_date' => Yii::t('app', 'Create Date'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * Gets query for [[Request]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(Request::class, ['id' => 'request_id']);
    }
}
