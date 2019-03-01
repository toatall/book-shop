<?php

namespace app\controllers;

use Yii;
use app\models\Book;
use app\models\BookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\LinkBookCategory;
use yii\web\UploadedFile;

/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Book models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Book model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Book();
		
        if ($model->load(Yii::$app->request->post()))
        {        	

        	if ($this->uploadFile($model))
        	{        		        	
        		if ($model->save()) {        			        	
		        	$categories = isset(Yii::$app->request->post()['Book']['categories'])
		        		? Yii::$app->request->post()['Book']['categories'] : [];		        	
		        	$this->saveRelationCategory($model, $categories);
        	    	return $this->redirect(['view', 'id' => $model->id]);
              	}
        	}        	
        }
        
        return $this->render('create', [
        	'model' => $model,
        ]);       
    }

    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
        
        if ($model->load(Yii::$app->request->post()))
        {    
        	$attributes = $model->attributes();
        	if (!$this->uploadFile($model))
        	{    
        		if(($key = array_search('image', $attributes)) !== false) {
        			unset($attributes[$key]);
        		}        			
        	}
        	
        	if ($model->save(true, $attributes)) {
        		$categories = isset(Yii::$app->request->post()['Book']['categories'])
        			? Yii::$app->request->post()['Book']['categories'] : [];
        		$this->saveRelationCategory($model, $categories);
        		return $this->redirect(['view', 'id' => $model->id]);
        	}        	
        }
        
        return $this->render('update', [
        		'model' => $model,
        ]);
                      
    }
    
   	/**
   	 * Загрузка файла
   	 * @author oleg
   	 * @param unknown $model
   	 */
    private function uploadFile(Book $model)
    {
    	$fileName = false;    	
    	if (Yii::$app->request->isPost)
    	{
    		if ($model->isNewRecord || (UploadedFile::getInstance($model, 'image') != null))
    		{
    			$model->image = UploadedFile::getInstance($model, 'image');
    			if ($model->upload() !== false)
	    		{
	    			return true;
	    		}
	    		else return false;    			
    		}
    	}
    	return false;
    }
    
    /**
     * Сохранение связей с категориями
     * @author oleg
     * @param Book $model
     */
    private function saveRelationCategory(Book $model, $categories)
    {
    	// сначала все удалим
    	LinkBookCategory::deleteAll(['id_book' => $model->id]);
    	// затем добавим связи
    	if (!is_array($categories)) $categories = [];
    		    	
    	foreach ($categories as $link)
    	{
    		Yii::$app->db->createCommand()->insert('{{%link_book_category}}', [
    			'id_book' => $model->id,
    			'id_category' => $link,
    		])->execute();
    	}
    	
    }
    

    /**
     * Deletes an existing Book model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
