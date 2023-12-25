<?php

namespace app\modules\engineer\models;

use app\models\User;
use Yii;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * This is the model class for table "en_technician".
 *
 * @property int $id
 * @property string|null $photo รูปภาพ
 * @property string|null $tel เบอร์ติดต่อ
 * @property int|null $active สถานะ
 * @property string|null $name ชื่อ-สกุล
 * @property int|null $head หัวหน้า
 *
 * @property Actor[] $enActors
 */
class Technician extends \yii\db\ActiveRecord
{

    public $upload_foler = 'uploads/technician';


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'en_technician';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active', 'head'], 'integer'],
            [['manday'], 'number'],
            [['name', 'code', 'email'], 'string', 'max' => 255],
            [['tel', 'line'], 'string', 'max' => 45],
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
            'code' => Yii::t('app', 'รหัสพนักงาน'),
            'name' => Yii::t('app', 'ชื่อ-สกุล'),
            'photo' => Yii::t('app', 'รูปภาพ'),
            'email' => Yii::t('app', 'อีเมล'),
            'line' => Yii::t('app', 'ไลน์'),
            'tel' => Yii::t('app', 'เบอร์ติดต่อ'),
            'manday' => Yii::t('app', 'ค่าแรง'),
            'active' => Yii::t('app', 'สถานะ'),
            'head' => Yii::t('app', 'หัวหน้า'),
        ];
    }

    /**
     * Gets query for [[EnActors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getActors0()
    {
        return $this->hasMany(Actor::class, ['technician_id' => 'id']);
    }

    public function getHead0()
    {
        return $this->hasOne(User::class, ['id' => 'head']);
    }

    public function getActiveStatus()
    {
        $color = $this->active === 1 ? '#1A5D1A' : '#FE0000';
        $statusText = $this->active === 1 ? Yii::t('app', 'Yes') : Yii::t('app', 'No');

        return [$color, $statusText];
    }

    public function upload($model, $attribute)
    {
        $photo  = UploadedFile::getInstance($model, $attribute);
        $path = $this->getUploadPath();
        if ($this->validate() && $photo !== null) {

            $fileName = md5($photo->baseName . time()) . '.' . $photo->extension;
            //$fileName = $photo->baseName . '.' . $photo->extension;
            if ($photo->saveAs($path . $fileName)) {
                return $fileName;
            }
        }
        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }

    public function getUploadPath()
    {
        return Yii::getAlias('@webroot') . '/' . $this->upload_foler . '/';
    }

    public function getUploadUrl()
    {
        return Yii::getAlias('@web') . '/' . $this->upload_foler . '/';
    }

    public function getPhotoViewer()
    {
        return empty($this->photo) ? Yii::getAlias('@web') . '/images/avatar.jpg' : $this->getUploadUrl() . $this->photo;
    }
}
