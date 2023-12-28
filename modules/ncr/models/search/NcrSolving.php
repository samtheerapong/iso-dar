<?php

namespace app\modules\ncr\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\ncr\models\NcrSolving as NcrSolvingModel;

/**
 * NcrSolving represents the model behind the search form of `app\modules\ncr\models\NcrSolving`.
 */
class NcrSolving extends NcrSolvingModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ncr_id', 'solving_type_id', 'quantity', 'operation_name', 'ncr_concession_id', 'customer_name', 'approve_name'], 'integer'],
            [['unit', 'proceed', 'operation_date', 'process', 'cause', 'approve_date', 'docs', 'ref'], 'safe'],
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
        $query = NcrSolvingModel::find();

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
            'solving_type_id' => $this->solving_type_id,
            'quantity' => $this->quantity,
            'operation_date' => $this->operation_date,
            'operation_name' => $this->operation_name,
            'ncr_concession_id' => $this->ncr_concession_id,
            'customer_name' => $this->customer_name,
            'approve_name' => $this->approve_name,
            'approve_date' => $this->approve_date,
        ]);

        $query->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'proceed', $this->proceed])
            ->andFilterWhere(['like', 'process', $this->process])
            ->andFilterWhere(['like', 'cause', $this->cause])
            ->andFilterWhere(['like', 'docs', $this->docs])
            ->andFilterWhere(['like', 'ref', $this->ref]);

        return $dataProvider;
    }
}
