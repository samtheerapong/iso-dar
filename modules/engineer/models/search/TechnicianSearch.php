<?php

namespace app\modules\engineer\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\engineer\models\Technician;

/**
 * TechnicianSearch represents the model behind the search form of `app\modules\engineer\models\Technician`.
 */
class TechnicianSearch extends Technician
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'active', 'head'], 'integer'],
            [['manday'], 'number'],
            [['photo', 'tel', 'name', 'code', 'email', 'line'], 'safe'],
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
        $query = Technician::find();

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
            'active' => $this->active,
            'head' => $this->head,
            'manday' => $this->manday,
        ]);

        $query->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'line', $this->line])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
