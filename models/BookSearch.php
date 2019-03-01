<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Book;

/**
 * BookSearch represents the model behind the search form about `app\models\Book`.
 */
class BookSearch extends Book
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'count_page', 'count_book_stock'], 'integer'],
            [['title', 'description', 'ISBN', 'image', 'date_create', 'date_edit', 'author'], 'safe'],
            [['price', 'discount'], 'number'],
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
        $query = Book::find();

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
            'id' => $this->id,
            'count_page' => $this->count_page,
            'count_book_stock' => $this->count_book_stock,
            'price' => $this->price,
            'discount' => $this->discount,
            'date_create' => $this->date_create,
            'date_edit' => $this->date_edit,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'ISBN', $this->ISBN])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'author', $this->author]);

        return $dataProvider;
    }
    
    
    public static function searchUser($q)
    {
    	$query = Book::find()
    		->orFilterWhere(['like', 'title', $q])
    		->orFilterWhere(['like', 'description', $q])
    		->orFilterWhere(['like', 'ISBN', $q])
    		->orFilterWhere(['like', 'author', $q]);
    	return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}
