<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\author;

/**
 * AuthorSearch represents the model behind the search form about `app\models\author`.
 */
class AuthorSearch extends author
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	['id', 'integer'],
            [['author', 'date_create'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = author::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'date_create' => $this->date_create,
        	'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'author', $this->author]);

        return $dataProvider;
    }
}
