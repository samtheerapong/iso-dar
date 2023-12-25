<?php

namespace app\modules\engineer\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\engineer\models\RpList;

/**
 * RpListSearch represents the model behind the search form of `app\modules\engineer\models\RpList`.
 */
class RpListSearch extends RpList
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'request_id', 'amount', 'location'], 'integer'],
            [['detail_list', 'request_date', 'broken_date', 'photo', 'remask'], 'safe'],
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
        $query = RpList::find();

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
            'request_id' => $this->request_id,
            'request_date' => $this->request_date,
            'broken_date' => $this->broken_date,
            'amount' => $this->amount,
            'location' => $this->location,
        ]);

        $query->andFilterWhere(['like', 'detail_list', $this->detail_list])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'remask', $this->remask]);

        return $dataProvider;
    }
}
