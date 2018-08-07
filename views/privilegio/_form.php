<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Privilegio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="privilegio-form">

    <?php $form = ActiveForm::begin(); ?>

  <p> Habitaciones

    <?= $form->field($model, 'crear_habitacion')->checkbox(array('label'=>'Crear habitación')); ?>

    <?= $form->field($model, 'modificar_habitacion')->checkbox(array('label'=>'Modificar habitación')); ?>

    <?= $form->field($model, 'eliminar_habitacion')->checkbox(array('label'=>'Eliminar habitación')); ?>

    <?= $form->field($model, 'crear_tipo_habitacion')->checkbox(array('label'=>'Crear tipo habitación')); ?>

    <?= $form->field($model, 'modificar_tipo_habitacion')->checkbox(array('label'=>'Modificar tipo de habitación')); ?>

    <?= $form->field($model, 'eliminar_tipo_habitacion')->checkbox(array('label'=>'Eliminar tipo habitación')); ?>

  </p>
  <p> Caja

    <?= $form->field($model, 'modificar_caja')->checkbox(array('label'=>'Modificar caja')); ?>

  </p>
  <p> Huéspedes

    <?= $form->field($model, 'crear_huesped')->checkbox(array('label'=>'Crear huésped')); ?>

    <?= $form->field($model, 'modificar_huesped')->checkbox(array('label'=>'Modificar huésped')); ?>

    <?= $form->field($model, 'eliminar_huesped')->checkbox(array('label'=>'Eliminar huésped')); ?>

  </p>
  <p> Reservaciones

    <?= $form->field($model, 'crear_reservacion')->checkbox(array('label'=>'Crear reservación')); ?>

    <?= $form->field($model, 'modificar_reservacion')->checkbox(array('label'=>'Modificar reservación')); ?>

    <?= $form->field($model, 'eliminar_reservacion')->checkbox(array('label'=>'Eliminar reservación')); ?>

    <?= $form->field($model, 'descuento')->Input(['autofocus' => true], ['placeholder' => "Descuento"]) ?>

  </p>
  <p> Tarifas

    <?= $form->field($model, 'crear_tarifa')->checkbox(array('label'=>'Crear tarifa')); ?>

    <?= $form->field($model, 'modificar_tarifa')->checkbox(array('label'=>'Modificar tarifa')); ?>

    <?= $form->field($model, 'eliminar_tarifa')->checkbox(array('label'=>'Eliminar tarifa')); ?>

  </p>
  <p> Orígenes

    <?= $form->field($model, 'crear_origen')->checkbox(array('label'=>'Crear origen')); ?>

    <?= $form->field($model, 'modificar_origen')->checkbox(array('label'=>'Modificar origen')); ?>

    <?= $form->field($model, 'eliminar_origen')->checkbox(array('label'=>'Eliminar origen')); ?>

  </p>
  <p> Usuarios

    <?= $form->field($model, 'crear_usuario')->checkbox(array('label'=>'Crear usuario')); ?>

    <?= $form->field($model, 'modificar_usuario')->checkbox(array('label'=>'Modificar usuario')); ?>

    <?= $form->field($model, 'eliminar_usuario')->checkbox(array('label'=>'Eliminar usuario')); ?>

  </p>

</div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
