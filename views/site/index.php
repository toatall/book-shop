<?php

use yii\widgets\ListView;
use yii\widgets\ActiveForm;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Category;
use yii\web\View;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    
    <?php 
	    if ($category != null)
	    {	    	
	    	$this->params['breadcrumbs'][] = Category::findOne($category)->category;    
	    }
    ?>
       
	
    <div class="body-content">
    	<?= ListView::widget([
	        'dataProvider' => $dataProvider,
	        'itemView' => '_book',
	        'options' => [
		        'tag' => 'div',
		        'class' => 'news-list',
		        'id' => 'news-list',
		    ],
	    
	    'layout' => "{pager}\n{summary}\n<div class=\"masonry\">{items}</div>\n<div style=\"clear: both;\">{pager}</div>",
	    //'summary' => 'Показано {count} из {totalCount}',
	    'summary' => '',
	    'summaryOptions' => [
	        'tag' => 'span',
	        'class' => 'my-summary'
	    ],
	 
	    'itemOptions' => [
	        'tag' => 'div',
	        'class' => 'news-item',
	    ],
	 
	    'emptyText' => '<p>Список пуст</p>',
	    'emptyTextOptions' => [
	        'tag' => 'p'
	    ],
	 
	    'pager' => [
	        'firstPageLabel' => 'Первая',
	        'lastPageLabel' => 'Последняя',
	        'nextPageLabel' => 'Следующая',
	        'prevPageLabel' => 'Предыдущая',        
	        'maxButtonCount' => 5,
	    ],
    ]); ?>
    </div>
    
</div>
