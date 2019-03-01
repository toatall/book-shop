<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>  
	
	<?php if ($confirm): ?>
		
		<div class="alert alert-block">		 
		  <h4>Регистрация завершена!</h4>
		  Для подтверждения регистрации на почтоый адрес <strong><?= $model->email; ?></strong>
		  направлено письмо со ссылкой, по которой Вам необходимо перейти.<br />
		  <button class="btn btn-primary" onclick="window.location='<?= yii\helpers\Url::to(['site/index']) ?>'">Назад</button>
		</div>
	
	<?php elseif(isset($registration_confirm)): ?>	
		<div class="alert alert-<?= $result ?>">		 
			<?= $registration_confirm; ?>			
		</div>
		<button class="btn btn-primary" onclick="window.location='<?= yii\helpers\Url::to(['site/index']) ?>'">Назад</button>		
	<?php else: ?>
	
		<p>Заполните, пожалуйста, представленные ниже поля.</p>
		
		<div class="user-form">
		
		    <?php $form = ActiveForm::begin([
		    	'options' => ['enctype' => 'multipart/form-data'],
		    ]); ?>
		
			<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
			
		    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
		
		    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
		    
		    <?= $form->field($model, 'password_confirm')->passwordInput(['maxlength' => true]) ?>
			    	    
		    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
		
		    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>
		
		    <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true]) ?>
		
		    <?= $form->field($model, 'date_birthday')->textInput() ?>
		
		    <?= $form->field($model, 'photo')->fileInput() ?>
		
		    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>
			    
		    <div class="form-group">
		        <?= Html::submitButton('Регистрация', 
		        	['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		    </div>
		
		    <?php ActiveForm::end(); ?>
		
		</div>
		
	<?php endif; ?>
	
</div>
