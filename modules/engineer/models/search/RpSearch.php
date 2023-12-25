<?php

namespace app\modules\engineer\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\engineer\models\Rp;

/**
 * RpSearch represents the model behind the search form of `app\modules\engineer\models\Rp`.
 */
class RpSearch extends Rp
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'priority', 'urgency', 'request_by', 'department', 'created_by', 'updated_by', 'en_status_id'], 'integer'],
            [['repair_code', 'created_date', 'request_title', 'remask', 'created_at', 'updated_at'], 'safe'],
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
        $query = Rp::find();

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
            'priority' => $this->priority,
            'urgency' => $this->urgency,
            'created_date' => $this->created_date,
            'request_by' => $this->request_by,
            'department' => $this->department,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'en_status_id' => $this->en_status_id,
        ]);

        $query->andFilterWhere(['like', 'repair_code', $this->repair_code])
            ->andFilterWhere(['like', 'request_title', $this->request_title])
            ->andFilterWhere(['like', 'remask', $this->remask]);

        return $dataProvider;
    }
}
