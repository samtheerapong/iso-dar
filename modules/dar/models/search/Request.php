<?php

namespace app\modules\dar\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\dar\models\Request as RequestModel;

/**
 * Request represents the model behind the search form of `app\modules\dar\models\Request`.
 */
class Request extends RequestModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'request_type_id', 'request_category_id', 'department_id', 'created_by', 'updated_by', 'document_age', 'request_status_id'], 'integer'],
            [['document_code', 'request_name', 'created_at', 'updated_at', 'title', 'detail', 'public_date'], 'safe'],
            [['rev'], 'number'],
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
        $query = RequestModel::find();

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
            'rev' => $this->rev,
            'request_type_id' => $this->request_type_id,
            'request_category_id' => $this->request_category_id,
            'department_id' => $this->department_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'document_age' => $this->document_age,
            'public_date' => $this->public_date,
            'request_status_id' => $this->request_status_id,
        ]);

        $query->andFilterWhere(['like', 'document_code', $this->document_code])
            ->andFilterWhere(['like', 'request_name', $this->request_name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'detail', $this->detail]);

        return $dataProvider;
    }
}
