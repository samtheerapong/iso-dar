<?php

namespace app\modules\dar\models;

use Yii;

/**
 * This is the model class for table "request_rule".
 *
 * @property int $id
 * @property int|null $request_id
 * @property int|null $document_rule_id การควบคุม
 * @property string|null $detail รายละเอียด
 *
 * @property DocumentRule $documentRule
 * @property Request $request
 */
class RequestRule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request_rule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['request_id', 'document_rule_id'], 'integer'],
            [['detail'], 'string'],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::class, 'targetAttribute' => ['request_id' => 'id']],
            [['document_rule_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentRule::class, 'targetAttribute' => ['document_rule_id' => 'id']],
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
            'document_rule_id' => Yii::t('app', 'การควบคุม'),
            'detail' => Yii::t('app', 'รายละเอียด'),
        ];
    }

    /**
     * Gets query for [[DocumentRule]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentRule()
    {
        return $this->hasOne(DocumentRule::class, ['id' => 'document_rule_id']);
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
