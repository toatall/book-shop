<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "{{%book}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $ISBN
 * @property integer $count_page
 * @property integer $count_book_stock
 * @property string $image
 * @property string $price
 * @property string $discount
 * @property string $date_create
 * @property string $date_edit
 * @property string $author
 *
 * @property LinkBookAuthor[] $linkBookAuthors
 * @property LinkBookCategory[] $linkBookCategories
 * @property LinkOrderBook[] $linkOrderBooks
 */
class Book extends \yii\db\ActiveRecord
{
	
	public $_categoryList;	
	
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%book}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'price', 'ISBN', 
            		'count_page', 'count_book_stock', 'discount'], 'required'],
            [['description'], 'string'],
            [['count_page', 'count_book_stock'], 'integer'],
            [['price', 'discount'], 'number'],
            [['date_create', 'date_edit'], 'safe'],        	
            [['title', /*'image'*/], 'string', 'max' => 500],
        	[['image'], 'file', 'extensions' => 'png, jpg, bmp, gif'],        	
            [['ISBN'], 'string', 'max' => 50],
            [['author', 'authors'], 'string', 'max' => 250],
        	[['count_book_stock', 'count_page', 'discount'], 'default', 'value'=>0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'title' => 'Заголовок',
            'description' => 'Описание',
        	'authors' => 'Авторы',
            'ISBN' => 'Номер ISBN',
            'count_page' => 'Количество страниц',
            'count_book_stock' => 'В наличии',
            'image' => 'Фото',
            'price' => 'Цена',
            'discount' => 'Скидка',
            'date_create' => 'Дата создания',
            'date_edit' => 'Дата изменения',
            'author' => 'Автор',
        	'categories' => 'Категории',        	
        ];
    }  

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        //return $this->hasMany(LinkBookCategory::className(), ['id_book' => 'id']);
        return $this->hasMany(Category::className(), ['id' => 'id_category'])
        	->viaTable(LinkBookCategory::tableName(), ['id_book' => 'id']);
    }
	
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinkOrderBooks()
    {
        return $this->hasMany(LinkOrderBook::className(), ['id_book' => 'id']);
    }

    /**
     * @inheritdoc
     * @return BookQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BookQuery(get_called_class());
    }
          
    
    /**
     * Загрузка файла
     * @author oleg
     * @return boolean
     */
    public function upload()
    {
    	$fileName = false;
    	
    	if ($this->validate()) 
    	{    		
    		$fileName = 'files/book_image/' . $this->image->baseName . '.' . $this->image->extension;
    		if (file_exists($fileName))
    		{
    			$fileName = 'files/book_image/' . $this->generateFileName() . '.' . $this->image->extension;
    		}
    		$this->image->saveAs($fileName);
    		$this->image = $fileName;    		
    	}
    	
    	return $fileName;
    }
    
    /**
     * Генерирование имени файла
     * @author oleg 
     * @return string
     */
    private function generateFileName()
    {
    	return md5(date('d.m.Y H:i:s'));
    }
    
    
    public function afterFind()
    {
    	//$this->price = number_format($this->price, 2);    
    	
    	if (!file_exists($this->image))
    		$this->image = '/css/images/no_image.png';
    				
    	if (strlen($this->image) > 1 && substr($this->image, 0, 1) != '/')
    	{
    		$this->image = '/' . $this->image;
    	}    	
    	    	
    	return parent::afterFind();
    	
    }
    
    
    /**
     * Событие перед сохранение в БД
     * @author oleg
     * @see \yii\db\BaseActiveRecord::beforeSave($insert)
     */
    public function beforeSave($insert)
    {
    	$this->author = isset(Yii::$app->user->identity->username) 
    		? Yii::$app->user->identity->username : 'guest';
    			
    	if (!$this->isNewRecord)
    		$this->date_edit = new Expression('CURRENT_TIMESTAMP');
    	return parent::beforeSave($insert);
    }
    
    
    /**
     * Событие при удалении записи из БД
     * @author oleg
     * @see \yii\db\BaseActiveRecord::beforeDelete()
     */
    public function beforeDelete()
    {
    	$this->deleteFile($this->image);
    	LinkBookCategory::deleteAll('id_book=:id_book', [':id_book'=>$this->id]);
    	return parent::beforeDelete();
    }
    
    
    /**
     * Удаление файла
     * @author oleg
     * @param $fileName - имя файла для удаления
     * @return boolean
     */
    private function deleteFile($fileName)
    {    	
    	if (file_exists($fileName))
    	{
    		if (unlink($fileName))
    			return true;
    	}
    	return false;
    }
    
        
}
