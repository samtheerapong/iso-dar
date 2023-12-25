<?php

namespace app\modules\dar\models;

use Yii;

/**
 * This is the model class for table "approve".
 *
 * @property int $id
 * @property int|null $review_id
 * @property string|null $approve_name ทบทวนโดย
 * @property string|null $approve_at ทบทวนเมื่อ
 * @property string|null $comment ความคิดเห็นของผู้ทบทวน	
 * @property int|null $request_status_id สถานะ
 *
 * @property RequestStatus $requestStatus
 * @property Review $review
 */
class Approve extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'approve';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['review_id', 'request_status_id'], 'integer'],
            [['approve_at'], 'safe'],
            [['comment'], 'string'],
            [['approve_name'], 'string', 'max' => 255],
            [['request_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => RequestStatus::class, 'targetAttribute' => ['request_status_id' => 'id']],
            [['review_id'], 'exist', 'skipOnError' => true, 'targetClass' => Review::class, 'targetAttribute' => ['review_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'review_id' => Yii::t('app', 'Review ID'),
            'approve_name' => Yii::t('app', 'ทบทวนโดย'),
            'approve_at' => Yii::t('app', 'ทบทวนเมื่อ'),
            'comment' => Yii::t('app', 'ความคิดเห็นของผู้ทบทวน	'),
            'request_status_id' => Yii::t('app', 'สถานะ'),
        ];
    }

    /**
     * Gets query for [[RequestStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestStatus()
    {
        return $this->hasOne(RequestStatus::class, ['id' => 'request_status_id']);
    }

    /**
     * Gets query for [[Review]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReview()
    {
        return $this->hasOne(Review::class, ['id' => 'review_id']);
    }
}
