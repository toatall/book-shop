<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
 
<div class="thumbnail item" style="text-align: center;">  
	<?= Html::a(Html::img($model->image), ['/book/view', 'id'=>$model->id]) ?><br />
    <?= Html::a(Html::encode($model->title), ['/book/view', 'id'=>$model->id]) ?>
    <hr />
    
    <?php if ($model->discount>0) { ?><span class="price-discount">Специальная цена</span><br /><?php } ?>
    <span class="price"><?= number_format($model->price, 2, '.', '') ?></span> <span class="glyphicon glyphicon-ruble"></span>
</div>