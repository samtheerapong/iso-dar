<?php

namespace app\modules\jobs\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\jobs\models\Operations;

/**
 * OperationsSearch represents the model behind the search form of `app\modules\jobs\models\Operations`.
 */
class OperationsSearch extends Operations
{

    // New attribute for filtering by attribute
    public $job_status;
    public $request_by;
    public $job_department;
    public $title;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'job_id', 'operator_by', 'job_department'], 'integer'],
            [['details', 'sparepart_list', 'start_date', 'end_date', 'remask', 'docs', 'job_status', 'request_by', 'title'], 'safe'],
            [['cost'], 'number'],
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
        // $query = Operations::find();

        /**
         * Gets query for [[Job]]. 
         * ดูที่ Models
         */
        $query = Operations::find()->joinWith('job');


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
        ]);

        // No search? Then return data Provider
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'job_id' => $this->job_id,
            'operator_by' => $this->operator_by,
            'cost' => $this->cost,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        $query->andFilterWhere(['like', 'details', $this->details])
            ->andFilterWhere(['like', 'sparepart_list', $this->sparepart_list])
            ->andFilterWhere(['like', 'remask', $this->remask])
            ->andFilterWhere(['like', 'docs', $this->docs]);

        // filter job_status
        $query->andFilterWhere(['jobs.job_department' => $this->job_department]);
        $query->andFilterWhere(['jobs.job_status' => $this->job_status]);
        $query->andFilterWhere(['jobs.request_by' => $this->request_by]);
        $query->andFilterWhere(['like', 'jobs.title', $this->title]);

        return $dataProvider;
    }
}
