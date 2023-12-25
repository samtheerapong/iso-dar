<?php

namespace app\modules\engineer\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\engineer\models\Upload;

/**
 * UploadSearch represents the model behind the search form of `app\modules\engineer\models\Upload`.
 */
class UploadSearch extends Upload
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ref'], 'integer'],
            [['file_name', 'real_filename', 'created_at'], 'safe'],
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
        $query = Upload::find();

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
            'ref' => $this->ref,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'file_name', $this->file_name])
            ->andFilterWhere(['like', 'real_filename', $this->real_filename]);

        return $dataProvider;
    }
}
