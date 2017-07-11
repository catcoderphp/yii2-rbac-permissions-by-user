<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $model->isNewRecord ? $form->field($model, 'username')->textInput(['maxlength' => true]) : '' ?>
    <?= $model->isNewRecord ? $form->field($model, 'password_hash')->passwordInput(['value' => '']) : ''?>
    <?= $form->field($model, 'email')->input('email') ?>
    
    <!--
    <?= $model->isNewRecord ? '' : Html::a('Cambiar contraseña', ['change-password', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    -->
    <h1>Permisos</h1>
    <table class="table table-bordered">
        <tr>
            <th>Nombre</th>
            <th>Permisos
                <div style="float: right;">
                    <span>Todos los permisos </span>
                    <input type="checkbox" name="marcarTodo" id="marcarTodo" />
                </div>
            </th>
        </tr>
         <?php foreach ($permissions['permissions'] as $controller => $actions):?>
        <tr>
        <td width="50%">
        <h2><?php echo $controller;?></h2>
        </td>
        <td width="50%">
        <?php foreach ($actions['actions'] as $key => $action):?>
            <input type="checkbox" value="<?php echo $action;?>" name="permissions[<?php echo $controller?>][<?php echo $action;?>]" <?php echo isset($permissionsByUser[$controller.'_'.$model->id][$action])? 'checked' : '';?>>
            <span><?php echo $action;?></span><br />

        <?php endforeach;?>
        </td>
        </tr>
    <?php endforeach;?>
        <tr>
            <td colspan="2">
            <center>
                <div class="form-group">
                    <?php  echo Html::a('Cancelar', ['index'], ['class' => 'btn btn-danger btn-width']) ?>

                    <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary btn-width']) ?>
                </div>
            </center>
            </td>
        </tr>
    </table>
    <?php ActiveForm::end(); ?>

</div>
