<?php

namespace app\modules\ncr\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\ncr\models\NcrClosing;

class NcrClosingSearch extends NcrClosing
{

    public function rules()
    {
        return [
            [['id', 'ncr_id', 'accept', 'auditor', 'qmr'], 'integer'],
            [['accept_date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

 
    public function search($params)
    {
        $query = NcrClosing::find();

        // add conditions that should always apply here

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
            'ncr_id' => $this->ncr_id,
            'accept' => $this->accept,
            'auditor' => $this->auditor,
            'qmr' => $this->qmr,
            'accept_date' => $this->accept_date,
        ]);
        return $dataProvider;
    }
}
