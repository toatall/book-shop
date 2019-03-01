<?php 

use yii\bootstrap\ActiveForm;
use yii\widgets\ListView;
use yii\helpers\Html;



$this->title = 'Поиск';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="well" style="background-color: white;">
	<h1><?= $this->title; ?></h1>
	<hr />

	<?php ActiveForm::begin(['method'=>'get']); ?>
		<div class="input-group">
			<input type="text" name="q" class="form-control" value="<?= $q ?>">
		    <span class="input-group-btn">
			    <button class="btn btn-default" type="submit" id="btnSearch">
			    	<span class="glyphicon glyphicon-search"></span>
			    </button>                        
			   	<script type="text/javascript">
					/* $("#btnSearch").click(function() {
						window.location = '<?= \yii\helpers\Url::to(['/site/search']) ?>';
					});*/
				</script>
			</span>
		</div>
	<?php ActiveForm::end(); ?>
</div>

<?php if ($dataProvider !== null): ?>

    <?= ListView::widget([
	        'dataProvider' => $dataProvider,
	        'itemView' => '_book',
	        'options' => [
		        'tag' => 'div',
		        'class' => 'news-list',
		        'id' => 'news-list',
		    ],
	    
	    'layout' => "{pager}\n{summary}\n<div class=\"masonry\">{items}</div>\n<div style=\"clear: both;\">{pager}</div>",
	    'summary' => 'Показано {count} из {totalCount}',
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
    
<?php elseif (strlen($q)>0): ?>
	<div style="margin-top: 20px;">Необходимо ввести более <strong>4</strong> символов</div>
<?php endif; ?>