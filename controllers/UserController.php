<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
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
     * Регистрация пользователя
     */
    public function actionRegister()
    {
    	if (!Yii::$app->user->isGuest)
    		return $this->redirect(['site/index']);
    	
    	$model = new User(['scenario'=>'insert']);
    	
    	$confirm = false;
    	
    	if ($model->load(Yii::$app->request->post()) && $model->save()) {
    		$confirm = true;
    		$this->sendConfirmInformation($model);
    	}    	    	    	     
    	
    	return $this->render('register', [
    		'model' => $model,
    		'confirm' => $confirm,
    	]);
    	    	    
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
 	private function sendConfirmInformation($model)
 	{
 		$link = Url::toRoute(['/user/confirm', 
 					'key'=>md5($model->id . $model->email),
 					'login' => $model->username,
 			], true);
 		
 		$message = '<h2>Добрый день уважаемый ' . $model->username . '!</h2><br />'
 			. 'Для подтверждения регистрации на сайте ' . Yii::$app->homeUrl 
 			. ' перейдите по ссылке <a href="' . $link . '">' . $link . '</a>';
 		
 		Yii::$app->mailer->compose()
	    	->setFrom('web@localhost.ru')
	    	->setTo('trusov@r86.nalog.ru')
	    	->setSubject('Подтверждение регистрации')
	    	->setTextBody($message)
	    	->send();
 	}
 	
 	
 	 	
 	public function actionConfirm($key, $login)
 	{
 		$model = User::find()
 			->where('username=:username', [':username'=>$login])
 			->one();
 		
 		$registration_confirm = ''; $result = 'danger';
 		
 		if ($model == null || (md5($model->id . $model->email) != $key))
 		{
 			$registration_confirm = 'Адре ссылки некорректный!';
 		}
 		elseif ($model->registration_confirm == 1)
 		{
 			$registration_confirm = 'Подтверждение регистрации уже было выполнено!';
			$result = 'success';
 		}
 		else
 		{
 			$model->registration_confirm = 1;
 			if ($model->save())
 			{
 				$registration_confirm = 'Подтверждение регистрации успешно выполнено!';
 				$result = 'success';
 			}
 			else
 			{
 				echo 'Произошла ошибка при подтверждении регистрации!';
 			}
 			
 		}
 		
 		return $this->render('register', [
 				'model' => $model,
 				'confirm' => false,
 				'registration_confirm' => $registration_confirm,
 				'result' => $result,
 		]); 		 		
 		
 	}
 	
    
}
