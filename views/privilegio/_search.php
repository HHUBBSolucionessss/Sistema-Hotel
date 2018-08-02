<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PrivilegioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="privilegio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_usuario') ?>

    <?= $form->field($model, 'crear_habitacion') ?>

    <?= $form->field($model, 'modificar_habitacion') ?>

    <?= $form->field($model, 'eliminar_habitacion') ?>

    <?php // echo $form->field($model, 'crear_tipo_habitacion') ?>

    <?php // echo $form->field($model, 'modificar_tipo_habitacion') ?>

    <?php // echo $form->field($model, 'eliminar_tipo_habitacion') ?>

    <?php // echo $form->field($model, 'crear_caja') ?>

    <?php // echo $form->field($model, 'modificar_caja') ?>

    <?php // echo $form->field($model, 'eliminar_caja') ?>

    <?php // echo $form->field($model, 'crear_huesped') ?>

    <?php // echo $form->field($model, 'modificar_huesped') ?>

    <?php // echo $form->field($model, 'eliminar_huesped') ?>

    <?php // echo $form->field($model, 'crear_reservacion') ?>

    <?php // echo $form->field($model, 'modificar_reservacion') ?>

    <?php // echo $form->field($model, 'eliminar_reservacion') ?>

    <?php // echo $form->field($model, 'descuento') ?>

    <?php // echo $form->field($model, 'crear_tarifa') ?>

    <?php // echo $form->field($model, 'modificar_tarifa') ?>

    <?php // echo $form->field($model, 'eliminar_tarifa') ?>

    <?php // echo $form->field($model, 'crear_origen') ?>

    <?php // echo $form->field($model, 'modificar_origen') ?>

    <?php // echo $form->field($model, 'eliminar_origen') ?>

    <?php // echo $form->field($model, 'crear_usuario') ?>

    <?php // echo $form->field($model, 'modificar_usuario') ?>

    <?php // echo $form->field($model, 'eliminar_usuario') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
