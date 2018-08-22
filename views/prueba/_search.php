<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PruebaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prueba-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_habitacion') ?>

    <?= $form->field($model, 'id_origen') ?>

    <?= $form->field($model, 'id_huesped') ?>

    <?= $form->field($model, 'fecha_entrada') ?>

    <?php // echo $form->field($model, 'fecha_salida') ?>

    <?php // echo $form->field($model, 'notas') ?>

    <?php // echo $form->field($model, 'adultos') ?>

    <?php // echo $form->field($model, 'ninos') ?>

    <?php // echo $form->field($model, 'noches') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'estado_pago') ?>

    <?php // echo $form->field($model, 'tipo') ?>

    <?php // echo $form->field($model, 'saldo') ?>

    <?php // echo $form->field($model, 'subtotal') ?>

    <?php // echo $form->field($model, 'descuento') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'create_user') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <?php // echo $form->field($model, 'update_user') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
