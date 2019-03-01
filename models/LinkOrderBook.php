<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%link_order_book}}".
 *
 * @property integer $id
 * @property integer $id_order
 * @property integer $id_book
 * @property string $price
 * @property string $discount
 *
 * @property Book $idBook
 * @property Order $idOrder
 */
class LinkOrderBook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%link_order_book}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_order', 'id_book'], 'required'],
            [['id_order', 'id_book'], 'integer'],
            [['price', 'discount'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_order' => 'Id Order',
            'id_book' => 'Id Book',
            'price' => 'Price',
            'discount' => 'Discount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'id_book']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'id_order']);
    }
}
