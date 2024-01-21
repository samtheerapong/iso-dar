<?php

namespace app\modules\ncr\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\ncr\models\Ncr;

/**
 * NcrSearch represents the model behind the search form of `app\modules\ncr\models\Ncr`.
 */
class NcrSearch extends Ncr
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'month', 'year', 'department', 'ncr_process_id', 'category_id', 'sub_category_id', 'department_issue', 'report_by', 'ncr_status_id', 'created_by', 'updated_by'], 'integer'],
            [['ncr_number', 'created_date', 'lot', 'production_date', 'product_name', 'customer_name', 'datail', 'action', 'docs', 'ref', 'created_at', 'updated_at'], 'safe'],
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
        $query = Ncr::find();

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
            'created_date' => $this->created_date,
            'month' => $this->month,
            'year' => $this->year,
            'department' => $this->department,
            'ncr_process_id' => $this->ncr_process_id,
            'production_date' => $this->production_date,
            'category_id' => $this->category_id,
            'sub_category_id' => $this->sub_category_id,
            'department_issue' => $this->department_issue,
            'report_by' => $this->report_by,
            'ncr_status_id' => $this->ncr_status_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'ncr_number', $this->ncr_number])
            ->andFilterWhere(['like', 'lot', $this->lot])
            ->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'customer_name', $this->customer_name])
            ->andFilterWhere(['like', 'datail', $this->datail])
            ->andFilterWhere(['like', 'action', $this->action])
            ->andFilterWhere(['like', 'docs', $this->docs])
            ->andFilterWhere(['like', 'ref', $this->ref]);

        return $dataProvider;
    }
}
