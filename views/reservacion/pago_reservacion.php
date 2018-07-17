<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use kartik\select2\Select2;

use app\models\Reservacion;

/* @var $this yii\web\View */
/* @var $model app\models\Reservacion */
/* @var $form yii\widgets\ActiveForm */
$this->title = "Reservación con folio ".$model->id;
$pago->id_reservacion=$model->id;
?>


<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">
    var saldo='<?= $model->total ?>';
    var total=0;
    $( document ).ready(function()
    {    
        $("#_tarjeta").prop('disabled', true); 
        $("#_deposito").prop('disabled', true); 
        $('#_efectivo').val(0);   
        $('#_tarjeta').val(0);
        $('#_deposito').val(0);
        $('#_total').val(total);
        $('#_saldo').val(saldo);
    });

    function calcularTotales()
    {
        total=0;
        $('#_saldo').val(saldo);
        total=parseFloat($('#_efectivo').val()) + parseFloat($('#_tarjeta').val()) + parseFloat($('#_deposito').val());
        $('#_total').val(total);
        $('#_saldo').val(saldo-total);
        if($('#_saldo').val()<0)
        {
            alert("No se puede pagar una cantidad mayor a la del total, porfavor verifica los montos de pago")
            $("#_submit").prop('disabled', true);
        }
        else
        {
            $("#_submit").prop('disabled', false);

        }

    }

    $(document).on('change', '#_efectivo', function() 
    {
        calcularTotales();
        
    });

    $(document).on('change', '#_tarjeta', function() 
    {
        calcularTotales();

    });

    $(document).on('change', '#_deposito', function() 
    {
        calcularTotales();
    });

    $(document).on('change', '#_tipo', function() 
    {
        console.log($('#_tipo').val());

        switch ($('#_tipo').val()) 
        {
            case '0':
                    $('#_efectivo').val(0);
                    $('#_tarjeta').val(0);
                    $('#_deposito').val(0);
                    $("#_efectivo").prop('disabled', false);
                    $("#_tarjeta").prop('disabled', true); 
                    $("#_deposito").prop('disabled', true); 
                break;
            case '1':
                    $('#_efectivo').val(0);
                    $('#_tarjeta').val(0);
                    $('#_deposito').val(0);
                    $("#_tarjeta").prop('disabled', false); 
                    $("#_efectivo").prop('disabled', true); 
                    $("#_deposito").prop('disabled', true); 
                break;
            case '2':
                    $('#_efectivo').val(0);
                    $('#_tarjeta').val(0);
                    $('#_deposito').val(0);
                    $("#_deposito").prop('disabled', false); 
                    $("#_efectivo").prop('disabled', true); 
                    $("#_tarjeta").prop('disabled', true);  
                break;
            case '3':
                    $('#_efectivo').val(0);
                    $('#_tarjeta').val(0);
                    $('#_deposito').val(0);
                    $("#_deposito").prop('disabled', false); 
                    $("#_efectivo").prop('disabled', false); 
                    $("#_tarjeta").prop('disabled', false);  
                break;               
            default:
                break;
        }
    });



</script>

<div class="huesped-form">
        <h1><?= Html::encode($this->title) ?></h1>
            <div class="col-md-6 ">
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($pago, 'tipo_pago')->dropDownList(($model->tiposPago()),['id'=>'_tipo']);?>
                <?= $form->field($pago, 'efectivo')->textInput(['maxlength' => true,'id'=>'_efectivo']) ?>
                <?= $form->field($pago, 'tarjeta')->textInput(['maxlength' => true,'id'=>'_tarjeta']) ?>
                <?= $form->field($pago, 'deposito')->textInput(['maxlength' => true,'id'=>'_deposito']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Capturar Pago', ['class' => 'btn btn-success','id'=>'_submit']) ?>
                </div>

            </div>
            <div class="col-md-4">
                <?= $form->field($pago, 'total')->textInput(['readOnly' => true,'id'=>'_total']) ?>
                <?= $form->field($pago, 'saldo')->textInput(['readOnly' => true,'id'=>'_saldo']) ?>
            </div>
        <?php ActiveForm::end(); ?>
</div>
