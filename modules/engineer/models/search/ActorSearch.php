<?php

namespace app\modules\engineer\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\engineer\models\Actor;

/**
 * ActorSearch represents the model behind the search form of `app\modules\engineer\models\Actor`.
 */
class ActorSearch extends Actor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'en_wo_list_id', 'technician_id'], 'integer'],
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
        $query = Actor::find();

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
            'en_wo_list_id' => $this->en_wo_list_id,
            'technician_id' => $this->technician_id,
        ]);

        return $dataProvider;
    }
}
