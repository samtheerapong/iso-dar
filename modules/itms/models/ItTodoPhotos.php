<?php

namespace app\modules\itms\models;

use Yii;

/**
 * This is the model class for table "it_todo_photos".
 *
 * @property int $id
 * @property int|null $todo_id
 * @property string|null $photo_name
 *
 * @property ItTodo $todo
 */
class ItTodoPhotos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'it_todo_photos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['todo_id'], 'integer'],
            [['photo_name'], 'string', 'max' => 255],
            [['todo_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItTodo::class, 'targetAttribute' => ['todo_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'todo_id' => Yii::t('app', 'Todo ID'),
            'photo_name' => Yii::t('app', 'Photo Name'),
        ];
    }

    /**
     * Gets query for [[Todo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTodo()
    {
        return $this->hasOne(ItTodo::class, ['id' => 'todo_id']);
    }
}
