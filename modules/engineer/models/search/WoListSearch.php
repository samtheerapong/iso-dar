<?php

namespace app\modules\engineer\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\engineer\models\WoList;

/**
 * WoListSearch represents the model behind the search form of `app\modules\engineer\models\WoList`.
 */
class WoListSearch extends WoList
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'workorder_id', 'lock_out', 'tag_out', 'checker', 'recheck_electric', 'recheck_mechanics', 'rechecker'], 'integer'],
            [['working_date', 'description', 'problem', 'images'], 'safe'],
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
        $query = WoList::find();

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
            'workorder_id' => $this->workorder_id,
            'working_date' => $this->working_date,
            'lock_out' => $this->lock_out,
            'tag_out' => $this->tag_out,
            'checker' => $this->checker,
            'recheck_electric' => $this->recheck_electric,
            'recheck_mechanics' => $this->recheck_mechanics,
            'rechecker' => $this->rechecker,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'problem', $this->problem])
            ->andFilterWhere(['like', 'images', $this->images]);

        return $dataProvider;
    }
}
