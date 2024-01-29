<?php

namespace app\modules\ncr\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\ncr\models\NcrProtection;

/**
 * NcrProtectionSearch represents the model behind the search form of `app\modules\ncr\models\NcrProtection`.
 */
class NcrProtectionSearch extends NcrProtection
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ncr_id', 'operator'], 'integer'],
            [['issue', 'action', 'schedule_date', 'ncr_cause_item'], 'safe'],
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
        $query = NcrProtection::find();

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
            'schedule_date' => $this->schedule_date,
            'operator' => $this->operator,
        ]);

        $query->andFilterWhere(['like', 'issue', $this->issue])
            ->andFilterWhere(['like', 'ncr_cause_item', $this->ncr_cause_item])
            ->andFilterWhere(['like', 'action', $this->action]);

        return $dataProvider;
    }
}
