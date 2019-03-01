<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%author}}".
 *
 * @property string $author
 * @property string $date_create
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%author}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [        	
            [['author'], 'required'],
            [['date_create'], 'safe'],
            [['author'], 'string', 'max' => 50],
            [['author'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
        	'id' => 'ИД',
            'author' => 'Автор',
            'date_create' => 'Дата создания',
        ];
    }

    /**
     * @inheritdoc
     * @return AuthorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthorQuery(get_called_class());
    }
}
