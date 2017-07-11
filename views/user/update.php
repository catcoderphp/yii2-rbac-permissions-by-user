<?php

use yii\helpers\Html;
use  yii\web\View;
use yii\widget\JSRegister;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Usuario: '.$model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update" id="user-update">
    <h1 class="titulo"><?= Html::encode($this->title) ?></h1>
    <div class="panel">
        <div class="panel-body">
		    <?= $this->render('_form', [
		        'model' => $model,
		        'permissions' => $permissions,
		        'permissionsByUser' => $permissionsByUser,
		    ]) ?>
		</div>
	</div>
</div>

<?php $this->registerJsFile(
    '@web/../js/checkboxselectall.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
 );
?>
