<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1 class="titulo"><?= Html::encode($this->title) ?>
        <p class="pull-right">
            <?= in_array('create', $permissions)? Html::a('Crear Usuario', ['create'], ['class' => 'btn btn-primary']) : '' ?>
        </p>
    </h1>

    <div class="panel">
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'summary' => "Mostrando {begin}-{end} de {totalCount} Elementos",
                'emptyText' => "No se encontró ningún elemento",
                'rowOptions' => function ($model) {
                    if (!$model->status) {
                        return  ['class' =>'danger'];
                    }
                },
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'username',
                    'email:email',
                    [
                        'class' => 'yii\grid\ActionColumn', 'template' => '{update}, {active}',
                        'buttons' => [
                            'active' => function ($url, $model, $key) {     // render your custom button
                                return Html::a('', ['active', 'id' => $model->id], [
                                    'class' => $model->status ? 'fa fa-toggle-on fa-lg' : 'fa fa-toggle-off fa-lg',
                                        'data'=>[
                                           'method'=>'post',
                                        ]
                                    ]
                                );
                            }
                        ],
                        'visibleButtons' => [
                            'update' => function () use ($permissions) {
                                return in_array('update', $permissions);
                            },
                            'active' => function () use ($permissions) {
                                return in_array('active', $permissions);
                            },
                        ]
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
