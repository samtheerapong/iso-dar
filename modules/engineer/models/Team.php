<?php

namespace app\modules\engineer\models;

use Yii;

/**
 * This is the model class for table "en_team".
 *
 * @property int $id
 * @property string|null $team_name ชื่อทีม
 * @property string|null $logo_team โลโก้ทีม
 * @property int|null $head_team หัวหน้าทีม
 * @property int|null $technician1 สมาชิก1
 * @property int|null $technician2 สมาชิก2
 * @property int|null $technician3 สมาชิก3
 * @property int|null $technician4 สมาชิก4
 * @property int|null $technician5 สมาชิก5
 * @property int|null $technician6 สมาชิก6
 * @property int|null $technician7 สมาชิก7
 * @property int|null $technician8 สมาชิก8
 * @property int|null $technician9 สมาชิก9
 * @property int|null $technician10 สมาชิก10
 */
class Team extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'en_team';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['head_team', 'technician1', 'technician2', 'technician3', 'technician4', 'technician5', 'technician6', 'technician7', 'technician8', 'technician9', 'technician10'], 'integer'],
            [['team_name', 'logo_team'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'team_name' => Yii::t('app', 'ชื่อทีม'),
            'logo_team' => Yii::t('app', 'โลโก้ทีม'),
            'head_team' => Yii::t('app', 'หัวหน้าทีม'),
            'technician1' => Yii::t('app', 'สมาชิก1'),
            'technician2' => Yii::t('app', 'สมาชิก2'),
            'technician3' => Yii::t('app', 'สมาชิก3'),
            'technician4' => Yii::t('app', 'สมาชิก4'),
            'technician5' => Yii::t('app', 'สมาชิก5'),
            'technician6' => Yii::t('app', 'สมาชิก6'),
            'technician7' => Yii::t('app', 'สมาชิก7'),
            'technician8' => Yii::t('app', 'สมาชิก8'),
            'technician9' => Yii::t('app', 'สมาชิก9'),
            'technician10' => Yii::t('app', 'สมาชิก10'),
        ];
    }
}
