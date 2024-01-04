<?php

namespace app\modules\itms\models;

use app\models\User;
use Yii;

/**
 * This is the model class for table "it_todo_list".
 *
 * @property int $id
 * @property int|null $todo_id TO DO
 * @property int|null $todo_type_id ประเภท
 * @property int|null $hardware_id ฮาร์ดแวร์
 * @property string|null $start_date วันที่เริ่ม
 * @property string|null $end_date วันที่เสร็จ
 * @property string|null $activity กิจกรรม
 * @property int|null $operator_name ผู้ปฏิบัติงาน
 * @property float|null $cost ค่าใช้จ่าย
 * @property string|null $note บันทึก
 * @property string|null $docs เอกสาร
 *
 * @property ItTodoHardware $hardware
 * @property User $operatorName
 * @property User $operatorName0
 * @property ItTodo $todo
 * @property ItTodoType $todoType
 */
class ItTodoList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'it_todo_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['todo_id', 'todo_type_id', 'hardware_id', 'operator_name'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['activity', 'note', 'docs'], 'string'],
            [['cost'], 'number'],
            [['hardware_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItTodoHardware::class, 'targetAttribute' => ['hardware_id' => 'id']],
            [['todo_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItTodo::class, 'targetAttribute' => ['todo_id' => 'id']],
            [['todo_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItTodoType::class, 'targetAttribute' => ['todo_type_id' => 'id']],
            [['operator_name'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['operator_name' => 'id']],
            [['operator_name'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['operator_name' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'todo_id' => Yii::t('app', 'TO DO'),
            'todo_type_id' => Yii::t('app', 'ประเภท'),
            'hardware_id' => Yii::t('app', 'ฮาร์ดแวร์'),
            'start_date' => Yii::t('app', 'วันที่เริ่ม'),
            'end_date' => Yii::t('app', 'วันที่เสร็จ'),
            'activity' => Yii::t('app', 'กิจกรรม'),
            'operator_name' => Yii::t('app', 'ผู้ปฏิบัติงาน'),
            'cost' => Yii::t('app', 'ค่าใช้จ่าย'),
            'note' => Yii::t('app', 'บันทึก'),
            'docs' => Yii::t('app', 'เอกสาร'),
        ];
    }

    /**
     * Gets query for [[Hardware]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHardware()
    {
        return $this->hasOne(ItTodoHardware::class, ['id' => 'hardware_id']);
    }

    /**
     * Gets query for [[OperatorName]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOperatorName()
    {
        return $this->hasOne(User::class, ['id' => 'operator_name']);
    }

    /**
     * Gets query for [[OperatorName0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOperatorName0()
    {
        return $this->hasOne(User::class, ['id' => 'operator_name']);
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

    /**
     * Gets query for [[TodoType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTodoType()
    {
        return $this->hasOne(ItTodoType::class, ['id' => 'todo_type_id']);
    }
}
