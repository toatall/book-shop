<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use yii\base\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    	<?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Измеинть', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
        	[
        		'attribute' => 'image',
        		'value' => Html::a(Html::img($model->image, ['style'=>'width: 200px;']),
        			$model->image, ['target'=>'_blank']), 
        			//. '<br />' . Html::a($model->image, $model->image, ['target'=>'_blank'])
        			
        		'format' => 'raw',
        	],
            'id',
            'title',
            'description:ntext',
        	[
        		'attribute' => 'categories',        		
        		'value' => implode('<br />', ArrayHelper::map($model->categories, 'id', 'category')),
        		'format' => 'raw',
        	],
            'ISBN',
        	'authors',
            'count_page',
            'count_book_stock',            
        	
            'price',
            'discount',
        	'author',
            'date_create',
            'date_edit',            
        	
        ],
    ]) ?>

</div>
