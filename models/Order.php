<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $pay_type
 * @property integer $status
 * @property string $date_create
 * @property string $date_edit
 * @property string $author
 *
 * @property LinkOrderBook[] $linkOrderBooks
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'pay_type', 'status', 'author'], 'required'],
            [['id_user', 'pay_type', 'status'], 'integer'],
            [['date_create', 'date_edit'], 'safe'],
            [['author'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'pay_type' => 'Pay Type',
            'status' => 'Status',
            'date_create' => 'Date Create',
            'date_edit' => 'Date Edit',
            'author' => 'Author',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinkOrderBooks()
    {
        return $this->hasMany(LinkOrderBook::className(), ['id_order' => 'id']);
    }

    /**
     * @inheritdoc
     * @return OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderQuery(get_called_class());
    }
}
