<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Prueba */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prueba-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_habitacion')->textInput() ?>

    <?= $form->field($model, 'id_origen')->textInput() ?>

    <?= $form->field($model, 'id_huesped')->textInput() ?>

    <?= $form->field($model, 'fecha_entrada')->textInput() ?>

    <?= $form->field($model, 'fecha_salida')->textInput() ?>

    <?= $form->field($model, 'notas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adultos')->textInput() ?>

    <?= $form->field($model, 'ninos')->textInput() ?>

    <?= $form->field($model, 'noches')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'estado_pago')->textInput() ?>

    <?= $form->field($model, 'tipo')->textInput() ?>

    <?= $form->field($model, 'saldo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subtotal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descuento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'create_user')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <?= $form->field($model, 'update_user')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
