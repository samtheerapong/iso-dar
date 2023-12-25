<?php

namespace app\modules\nfc\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\nfc\models\Part;

/**
 * PartSearcn represents the model behind the search form of `app\modules\nfc\models\Part`.
 */
class PartSearcn extends Part
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'en_part_doc_id', 'en_part_group_id', 'en_part_type_id', 'unit_lg', 'unit_sm', 'cost', 'active', 'imported', 'status'], 'integer'],
            [['photo', 'code', 'name', 'name_en', 'old_code', 'description', 'serial_no', 'price', 'last_date', 'remask'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Part::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'en_part_doc_id' => $this->en_part_doc_id,
            'en_part_group_id' => $this->en_part_group_id,
            'en_part_type_id' => $this->en_part_type_id,
            'unit_lg' => $this->unit_lg,
            'unit_sm' => $this->unit_sm,
            'cost' => $this->cost,
            'active' => $this->active,
            'last_date' => $this->last_date,
            'imported' => $this->imported,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'name_en', $this->name_en])
            ->andFilterWhere(['like', 'old_code', $this->old_code])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'serial_no', $this->serial_no])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'remask', $this->remask]);

        return $dataProvider;
    }
}
