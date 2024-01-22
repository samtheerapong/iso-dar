<?php

namespace app\modules\ncr\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\ncr\models\NcrAccept;

/**
 * NcrAcceptSearch represents the model behind the search form of `app\modules\ncr\models\NcrAccept`.
 */
class NcrAcceptSearch extends NcrAccept
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ncr_id', 'ncr_concession_id', 'approve_name'], 'integer'],
            [['customer_name', 'process', 'cause', 'approve_date'], 'safe'],
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
        $query = NcrAccept::find();

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
            'ncr_id' => $this->ncr_id,
            'ncr_concession_id' => $this->ncr_concession_id,
            'approve_name' => $this->approve_name,
            'approve_date' => $this->approve_date,
        ]);

        $query->andFilterWhere(['like', 'customer_name', $this->customer_name])
            ->andFilterWhere(['like', 'process', $this->process])
            ->andFilterWhere(['like', 'cause', $this->cause]);

        return $dataProvider;
    }
}
