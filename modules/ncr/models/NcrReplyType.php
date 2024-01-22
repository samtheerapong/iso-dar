<?php

namespace app\modules\ncr\models;

use Yii;

/**
 * This is the model class for table "ncr_reply_type".
 *
 * @property int $id
 * @property string|null $name ชื่อ
 * @property string|null $color สี
 * @property int|null $active สถานะ
 *
 * @property NcrReply[] $ncrReplies
 */
class NcrReplyType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ncr_reply_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['color'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'ชื่อ'),
            'color' => Yii::t('app', 'สี'),
            'active' => Yii::t('app', 'สถานะ'),
        ];
    }

    /**
     * Gets query for [[NcrReplies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNcrReplies()
    {
        return $this->hasMany(NcrReply::class, ['reply_type_id' => 'id']);
    }
}
