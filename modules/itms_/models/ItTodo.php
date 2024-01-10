<?php

namespace app\modules\itms\models;

use app\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\BaseActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "it_todo".
 *
 * @property int $id
 * @property string|null $code รหัส
 * @property string|null $todo_date วันที่แจ้ง
 * @property string|null $title หัวข้อ
 * @property string|null $description รายละเอียด
 * @property int|null $request_name ผู้แจ้ง
 * @property string|null $photo รูปภาพ
 * @property int|null $status_id สถานะ
 * @property string|null $created_at วันที่บันทึก
 * @property int|null $created_by บันทึกโดย
 * @property string|null $updated_at วันที่ปรับปรุง
 * @property int|null $updated_by ปรับปรุงโดย
 *
 * @property User $createdBy
 * @property ItTodoList[] $itTodoLists
 * @property ItTodoStatus $status
 * @property User $updatedBy
 */
class ItTodo extends \yii\db\ActiveRecord
{

    public $upload_foler = 'uploads/todo';

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => ['created_at'],
                    self::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => function () {
                    return date('Y-m-d H:i:s');
                },
            ],
            [
                'class' => BlameableBehavior::class,
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_by', 'updated_by'],
                    BaseActiveRecord::EVENT_BEFORE_UPDATE => ['updated_by'],
                ],
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'it_todo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['todo_date', 'created_at', 'updated_at'], 'safe'],
            [['description'], 'string'],
            [['request_name', 'status_id', 'created_by', 'updated_by'], 'integer'],
            [['code'], 'string', 'max' => 45],
            [['title'], 'string', 'max' => 255],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItTodoStatus::class, 'targetAttribute' => ['status_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
            [['photo'], 'file', 'skipOnEmpty' => true],
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
            'todo_date' => Yii::t('app', 'วันที่แจ้ง'),
            'title' => Yii::t('app', 'หัวข้อ'),
            'description' => Yii::t('app', 'รายละเอียด'),
            'request_name' => Yii::t('app', 'ผู้แจ้ง'),
            'photo' => Yii::t('app', 'รูปภาพ'),
            'status_id' => Yii::t('app', 'สถานะ'),
            'created_at' => Yii::t('app', 'วันที่บันทึก'),
            'created_by' => Yii::t('app', 'บันทึกโดย'),
            'updated_at' => Yii::t('app', 'วันที่ปรับปรุง'),
            'updated_by' => Yii::t('app', 'ปรับปรุงโดย'),
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[ItTodoLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItTodoLists()
    {
        return $this->hasMany(ItTodoList::class, ['todo_id' => 'id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(ItTodoStatus::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

     /**
     * Gets query for [[RequestName]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestName()
    {
        return $this->hasOne(User::class, ['id' => 'request_name']);
    }

    //------------ Upload file --------------------------------//
    public function getUploadPath()
    {
        return Yii::getAlias('@webroot') . '/' . $this->upload_foler . '/';
    }

    public function getUploadUrl()
    {
        return Yii::getAlias('@web') . '/' . $this->upload_foler . '/';
    }

    public function upload($model, $attribute)
    {
        $photo  = UploadedFile::getInstance($model, $attribute);
        $path = $this->getUploadPath();
        if ($this->validate() && $photo !== null) {

            $fileName = md5($photo->baseName . time()) . '.' . $photo->extension;
            if ($photo->saveAs($path . $fileName)) {
                return $fileName;
            }
        }
        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }

    public function getPhotoViewer()
    {
        return empty($this->photo) ? Yii::getAlias('@web') . '/uploads/no-image.jpg' : $this->getUploadUrl() . $this->photo;
    }
}
