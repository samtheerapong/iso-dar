<?php

namespace app\modules\jobs\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\jobs\models\Jobs;

/**
 * JobsSearch represents the model behind the search form of `app\modules\jobs\models\Jobs`.
 */
class JobsSearch extends Jobs
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'request_by', 'job_department', 'location', 'job_type', 'urgency', 'job_status'], 'integer'],
            [['number', 'request_date', 'title', 'description', 'equipment', 'remask', 'docs'], 'safe'],
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
        $query = Jobs::find();

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
            'request_date' => $this->request_date,
            'request_by' => $this->request_by,
            'job_department' => $this->job_department,
            'location' => $this->location,
            'job_type' => $this->job_type,
            'urgency' => $this->urgency,
            'job_status' => $this->job_status,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'equipment', $this->equipment])
            ->andFilterWhere(['like', 'remask', $this->remask])
            ->andFilterWhere(['like', 'docs', $this->docs]);

        return $dataProvider;
    }
}
