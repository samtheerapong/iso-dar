<?php

namespace app\modules\engineer\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\engineer\models\Team;

/**
 * TeamSearch represents the model behind the search form of `app\modules\engineer\models\Team`.
 */
class TeamSearch extends Team
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'head_team', 'technician1', 'technician2', 'technician3', 'technician4', 'technician5', 'technician6', 'technician7', 'technician8', 'technician9', 'technician10'], 'integer'],
            [['team_name', 'logo_team'], 'safe'],
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
        $query = Team::find();

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
            'head_team' => $this->head_team,
            'technician1' => $this->technician1,
            'technician2' => $this->technician2,
            'technician3' => $this->technician3,
            'technician4' => $this->technician4,
            'technician5' => $this->technician5,
            'technician6' => $this->technician6,
            'technician7' => $this->technician7,
            'technician8' => $this->technician8,
            'technician9' => $this->technician9,
            'technician10' => $this->technician10,
        ]);

        $query->andFilterWhere(['like', 'team_name', $this->team_name])
            ->andFilterWhere(['like', 'logo_team', $this->logo_team]);

        return $dataProvider;
    }
}
