<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <?php
    NavBar::begin([
        //'brandLabel' => '<span class="glyphicon-book"></span> My Company',
        'brandLabel' => Html::img('@web/css/images/book-logo.png', ['alt'=>Yii::$app->name]),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
    	'encodeLabels' => false,
        'items' => [
            //['label' => '<span class="glyphicon glyphicon-home"></span> Главная', 'url' => ['/site/index']],
        	['label' => '<span class="glyphicon glyphicon-search"></span> Поиск', 'url' => ['/site/search']],
            //['label' => '<span class="glyphicon glyphicon-book"></span> О магазине', 'url' => ['/site/about']],
        	
        	!Yii::$app->user->isGuest && Yii::$app->user->identity->checkRoles(['manager']) ?         			
	        	['label' => '<span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;Структура', 'items' => [
	        		'<li class="dropdown-header">Справочники</li>',
	        		['label' => 'Категории', 'url' => ['/category/index']],
	        		['label' => 'Авторы', 'url' => ['/author/index']],
	        		        		
	                 '<li class="divider"></li>',
	                 '<li class="dropdown-header">Контент</li>',
	                 ['label' => 'Книги', 'url' => ['/book/index']],
	        	]]
        	 : '',
        	['label' => '<span class="glyphicon glyphicon-trash"></span> Корзина', 'url' => ['/site/basket']],
            ['label' => '<span class="glyphicon glyphicon-phone-alt"></span> Контакты', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ?
            ['label' => '<span class="glyphicon glyphicon-user"></span> Вход', 'url' => ['/site/login']] :
            ['label' => '<span class="glyphicon glyphicon-user"></span> ' . Yii::$app->user->identity->username, 'items' => [
            	['label' => 'Профиль', 'url' => ['/user/view', 'id'=>Yii::$app->user->identity->id]],
            	[
                    'label' => 'Выход',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
            	]
            ]],
        	Yii::$app->user->isGuest ? (
        		['label' => '<span class="glyphicon glyphicon-ok"></span> Регистрация', 'url' => ['/user/register']]
        	) : '',
        ],
    ]);
    NavBar::end();
    ?>
    <hr />
    
    <div class="container">
    
        <div class="row">
            <div class="col-lg-9">
                <?= Breadcrumbs::widget([
                    	'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= $content ?>
            </div>
            
            <div class="col-lg-3">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Поиск</h4>                    
                    <?php ActiveForm::begin(['method'=>'get', 'action'=> ['/site/search']]); ?>
                    	<?php if (isset($_GET['q'])) { $q = $_GET['q']; } else { $q = ''; } ?>
                    	<div class="input-group">
	                        <input type="text" name="q" class="form-control" value="<?= $q ?>">
	                        <span class="input-group-btn">
	                            <button class="btn btn-default" type="submit" id="btnSearch">
	                                <span class="glyphicon glyphicon-search"></span>
	                        	</button>                        
	                        	<script type="text/javascript">
									$("#btnSearch").click(function() {
										window.location = '\yii\helpers\Url::to(['/site/search'])';
									});
	                        	</script>
	                        </span>
                    	</div>
                    <?php ActiveForm::end(); ?>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well" style="background-color: #fff;">
                    <h4>Категории</h4>
                    <hr />
                    <ul class="list-unstyled">
                    	<?php 
                    		foreach (app\models\Category::find()->each() as $category):
                    	?>
                    	<li><?= yii\helpers\Html::a($category->category, ['site/index', 'category'=>$category->id]) ?></li>
                    	<?php 
                    		endforeach;
                    	?>
                    
                    	<!-- li><a href="#">Новинки</a></li>
                        <li><a href="#">Детская литератрура</a></li>                                
                        <li><a href="#">Учебная литература</a></li>                                
                        <li><a href="#">Бизнес-литератрура</a></li>                                
                        <li><a href="#">Художественная литература</a></li-->                               
                    </ul>                    
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Последние купленные книги</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>
            
        </div>
 </div>    
    
<footer class="footer" style="margin-top: 30px;">
    <div class="container">
        <p class="pull-left">&copy; Интернет-магазин "Книгоман" <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
        
   
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
