<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\TipoHabitacion;


use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Habitacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="habitacion-form">
    <div class="col-md-8">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'tipo_habitacion')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(TipoHabitacion::find()->all(), 'id', 'descripcion'),
                'value'=>1,
                'options' => ['placeholder' => 'Selecciona un tipo de habitación ...', 'select'=>'0'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        <?= $form->field($model, 'capacidad')->textInput() ?>
        <div class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>
