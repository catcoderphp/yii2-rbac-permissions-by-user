<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Crear Usuario';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1 class="titulo"><?= Html::encode($this->title) ?></h1>
    <div class="panel">
        <div class="panel-body">
		    <?= $this->render('_form', [
		        'model' => $model,
		        'permissions' => $permissions,
		    ]) ?>
		</div>
	</div>
</div>
