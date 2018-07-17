<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

use app\models\TipoHabitacion;
use app\models\Origen;


use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;


$this->title = 'Actualizar Tarifa';
$this->params['breadcrumbs'][] = ['label' => 'Tarifas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$js = 'jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-precio").each(function(index) {
        jQuery(this).html("Precio: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-precio").each(function(index) {
        jQuery(this).html("Precio: " + (index + 1))
    });
});
';
$this->registerJs($js);

?>



<div class="Tarifa-form">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($tarifa, 'nombre')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
             <?= $form->field($tarifa, 'id_origen')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Origen::find()->all(), 'id', 'nombre'),
                'value'=>1,
                'options' => ['placeholder' => 'Selecciona una habitación ...', 'select'=>'0'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($tarifa, 'id_tipo_habitacion')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(TipoHabitacion::find()->all(), 'id', 'descripcion'),
                'value'=>1,
                'options' => ['placeholder' => 'Selecciona un tipo de habitacion ...', 'select'=>'0'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <?php
            echo '<label class="control-label">Selecciona la fecha de inicio y fin de la tarifa</label>';
            echo DatePicker::widget([
                'model' => $tarifa,
                'attribute' => 'fecha_ini',
                'attribute2' => 'fecha_fin',
                'options' => ['placeholder' => 'Inicio Tarifa'],
                'options2' => ['placeholder' => 'Fin Tarifa'],
                'type' => DatePicker::TYPE_RANGE,
                'form' => $form,
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'autoclose' => true,
                ]
            ]);
        ?>
    </div>

    <div class="padding-v-md">
        <div class="line line-dashed">
        
        
        </div>
    </div>

    <div class="row">            
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 10, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $tarifasDetallada[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'adulto',
                    'ninos',
                    'precio',
                    'id_habitacion',
                ],

            ]); ?>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-envelope"></i> Tarifas
                    <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Agregar Precio</button>
                    <div class="clearfix"></div>
                </div>
                <div class="container-items"><!-- widgetContainer -->
                    <?php foreach ($tarifasDetallada as $index => $detalleTarifa): ?>
                        <div class="item panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <span class="panel-title-precio">Precio: <?= ($index + 1) ?></span>
                                <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                    // necessary for update action.
                                    if (!$detalleTarifa->isNewRecord) {echo Html::activeHiddenInput($detalleTarifa, "[{$index}]id");}
                                ?>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <?= $form->field($detalleTarifa, "[{$index}]adultos")->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?= $form->field($detalleTarifa, "[{$index}]precio")->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div><!-- end:row -->
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php DynamicFormWidget::end(); ?>
    </div>


    <div class="form-group">
        <?= Html::submitButton($detalleTarifa->isNewRecord ? 'Guardar Nueva' : 'Actualizar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>