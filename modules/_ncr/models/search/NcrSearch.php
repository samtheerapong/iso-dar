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
            [['id', 'year', 'month', 'department', 'ncr_process_id', 'category_id', 'sub_category_id', 'department_issue', 'report_by', 'ncr_status_id'], 'integer'],
            [['ncr_number', 'created_date', 'lot', 'production_date', 'product_name', 'customer_name', 'datail', 'troubleshooting', 'docs', 'ref'], 'safe'],
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

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC, // เรียงจากล่าสุดก่อน
                ],
            ],
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
        ]);

        $query->andFilterWhere(['like', 'ncr_number', $this->ncr_number])
            ->andFilterWhere(['like', 'lot', $this->lot])
            ->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'customer_name', $this->customer_name])
            ->andFilterWhere(['like', 'datail', $this->datail])
            ->andFilterWhere(['like', 'troubleshooting', $this->troubleshooting])
            ->andFilterWhere(['like', 'docs', $this->docs])
            ->andFilterWhere(['like', 'ref', $this->ref]);

        return $dataProvider;
    }
}
