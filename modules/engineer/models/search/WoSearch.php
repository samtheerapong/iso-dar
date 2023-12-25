<?php

namespace app\modules\engineer\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\engineer\models\Wo;

/**
 * WoSearch represents the model behind the search form of `app\modules\engineer\models\Wo`.
 */
class WoSearch extends Wo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rp_id', 'machine_id', 'work_type_id', 'category_id', 'frequency','workclass_id'], 'integer'],
            [['title', 'description', 'work_code', 'work_date', 'location', 'work_start', 'work_end', 'ref', 'work_method', 'service_date', 'remask'], 'safe'],
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
        $query = Wo::find();

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
            'rp_id' => $this->rp_id,
            'work_date' => $this->work_date,
            'machine_id' => $this->machine_id,
            'work_type_id' => $this->work_type_id,
            'work_start' => $this->work_start,
            'work_end' => $this->work_end,
            'workclass_id' => $this->workclass_id,
            'category_id' => $this->category_id,
            'service_date' => $this->service_date,
            'frequency' => $this->frequency,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'work_code', $this->work_code])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'ref', $this->ref])
            ->andFilterWhere(['like', 'work_method', $this->work_method])
            ->andFilterWhere(['like', 'remask', $this->remask]);

        return $dataProvider;
    }
}
