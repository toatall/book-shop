<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%link_book_category}}".
 *
 * @property integer $id
 * @property integer $id_book
 * @property string $category
 *
 * @property Book $idBook
 */
class LinkBookCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%link_book_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_book', 'id_category'], 'required'],
            [['id_book'], 'integer'],
            [['category'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_book' => 'Id Book',
            'id_category' => 'Id Category',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'id_book']);
    }
    
}
