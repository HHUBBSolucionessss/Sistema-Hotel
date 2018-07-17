<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Huesped */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="huesped-form">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'calle')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ciudad')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'pais')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'cp')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>
