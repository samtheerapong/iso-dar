<?php

namespace app\modules\itms\models;

use Yii;

/**
 * This is the model class for table "it_todo_hardware".
 *
 * @property int $id
 * @property string|null $code รหัส
 * @property string|null $name ชื่อ
 * @property int|null $active สถานะ
 *
 * @property ItTodoList[] $itTodoLists
 */
class ItTodoHardware extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'it_todo_hardware';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['code'], 'string', 'max' => 45],
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
            'active' => Yii::t('app', 'สถานะ'),
        ];
    }

    /**
     * Gets query for [[ItTodoLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItTodoLists()
    {
        return $this->hasMany(ItTodoList::class, ['hardware_id' => 'id']);
    }
}
