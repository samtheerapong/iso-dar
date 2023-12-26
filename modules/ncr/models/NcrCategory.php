<?php

namespace app\modules\ncr\models;

use Yii;

/**
 * This is the model class for table "ncr_category".
 *
 * @property int $id
 * @property string|null $category_name
 * @property string|null $color
 * @property int|null $active
 *
 * @property Ncr[] $ncrs
 */
class NcrCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ncr_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['category_name'], 'string', 'max' => 255],
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
            'category_name' => Yii::t('app', 'Category Name'),
            'color' => Yii::t('app', 'Color'),
            'active' => Yii::t('app', 'active'),
        ];
    }

    /**
     * Gets query for [[Ncrs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNcrs()
    {
        return $this->hasMany(Ncr::class, ['category_id' => 'id']);
    }
}
