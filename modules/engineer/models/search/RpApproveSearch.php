<?php

namespace app\modules\engineer\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\engineer\models\RpApprove;

/**
 * RpApproveSearch represents the model behind the search form of `app\modules\engineer\models\RpApprove`.
 */
class RpApproveSearch extends RpApprove
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'wo_id'], 'integer'],
            [['approver', 'approve_date', 'comment'], 'safe'],
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
        $query = RpApprove::find();

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
            'wo_id' => $this->wo_id,
            'approve_date' => $this->approve_date,
        ]);

        $query->andFilterWhere(['like', 'approver', $this->approver])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
