<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\data\ActiveDataProvider;
use app\models\Book;
use app\models\LinkBookCategory;
use app\models\BookSearch;

use app\filters\AccessRule;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
			        'class' => AccessRule::className(),
			    ],                
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                	[
                		'actions' => ['error', 'login', 'index', 'search', 'contact', 
                			'register', 'basket', 'about'],
                		'allow' => true,                		
                	],
                	/*[
                		'actions' => [''],
                		'allow' => true,
                		'roles' => ['user'],
                	],*/
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex($category = null)
    {
    	$dataProvider = new ActiveDataProvider([
    		'query' => Book::find()
    			->joinWith('categories')
    			->andFilterWhere(['>', 'count_book_stock', 0])
    			->where(($category!=null) ? ['id_category' => $category] : [])
    			->orderBy('date_edit DESC, date_create DESC'),
    		'pagination' => [
    			'pageSize' => 50,
    		],
    	]);
    	    	    
    	
    	return $this->render('index', [
    		'dataProvider' => $dataProvider, 
    		'category' =>$category,    		
    	]);

    }
    
    public function actionSearch($q=null)
    {
    
    	$dataProvider = null;
    	
    	if (strlen($q) >= 5)
    		$dataProvider = BookSearch::searchUser($q);
    	
    	return $this->render('search', [
    		'dataProvider' => $dataProvider, 
    		'q' =>$q,    		
    	]);
    	
    	
    }
    

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {    	
        return $this->render('about');
    }
}
