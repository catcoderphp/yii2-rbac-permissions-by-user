<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Usuario: '.$model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <h1 class="titulo"><?= Html::encode($this->title) ?></h1>
  	<div class="panel">
        <div class="panel-body">
		    <?= $this->render('_formChangePassword', [
		        'model' => $model,
		        'newPass' => $newPass,
		    ]) ?>
		</div>
	</div>
	
</div>