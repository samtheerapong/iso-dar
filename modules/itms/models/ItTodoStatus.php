<?php

namespace app\modules\itms\models;

use Yii;

/**
 * This is the model class for table "it_todo_status".
 *
 * @property int $id
 * @property string|null $name ชื่อ
 * @property string|null $color สี
 * @property int|null $active สถานะ
 *
 * @property ItTodo[] $itTodos
 */
class ItTodoStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'it_todo_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
     * Gets query for [[ItTodos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItTodos()
    {
        return $this->hasMany(ItTodo::class, ['status_id' => 'id']);
    }
}
