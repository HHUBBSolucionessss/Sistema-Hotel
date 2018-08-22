<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use yii\helpers\Json;

use app\models\Habitacion;
use app\models\Tarifa;
use app\models\Origen;

use kartik\widgets\ActiveForm;

use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use kartik\typeahead\Typeahead;
use yii\widgets\MaskedInput;
use kartik\money\MaskMoney;
use kartik\touchspin\TouchSpin;

use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Reservacion */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Modificar Reservación '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Reservaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= Html::encode($this->title) ?></h2>


<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://momentjs.com/downloads/moment.min.js"></script>
        <script type="text/javascript">
            //Variables Tarifas
            var tarifasJson;
            var tarifa;
            var fecha_salida ='<?php  echo $model->fecha_salida ?>';
            var fecha_entrada ='<?php  echo $model->fecha_entrada ?>';
            var tipo = <?= $tipo_habitacion ?>;
            var noches=diasT1=diasT2=diasT3=diasT4=total=subtotal=descuento=tarifa1=tarifa2=tarifa3=tarifa4=subtotal=0;

            function vaciarTarifas()
            {
                $("#_ltarifa1").text("Tarifa 1 ");
                $('#_tarifa1').val(0);
                $("#_ltarifa2").text("Tarifa 2 ");
                $('#_tarifa2').val(0);
                $("#_ltarifa3").text("Tarifa 3 ");
                $('#_tarifa3').val(0);
                $("#_ltarifa4").text("Tarifa 4 ");
                $('#_tarifa4').val(0);
                $('#_total').val(0);
                subtotal=0
            }
            //Funcion para calcular los días que tiene cada tarifa
            function calculoTarifa(numTarifas)
            {
                switch (numTarifas)
                {
                    case 1:
                        vaciarTarifas();
                        $("#_ltarifa1").text("Tarifa "+tarifa[0].nombre+" por "+noches+" Noches");
                        tarifa1=noches*tarifa[0].precio;
                        $('#_tarifa1').val(tarifa1);
                        $('#_subtotal').val(tarifa1);
                        $('#_total').val(tarifa1);
                        break;
                    case 2:
                        vaciarTarifas();
                        var fechafinT1=moment(tarifa[0].fecha_fin);
                        var fechaFin=moment(fecha_salida);
                        diasT1=fechafinT1.diff(fecha_entrada, 'days')+1;
                        diasT2=fechaFin.diff(tarifa[0].fecha_fin,'days')-1;

                        tarifa1=diasT1*tarifa[0].precio;
                        tarifa2=diasT2*tarifa[1].precio;
                        $("#_ltarifa1").text("Tarifa "+tarifa[0].nombre+" por "+diasT1+" Noches");
                        $('#_tarifa1').val(tarifa1);
                        $("#_ltarifa2").text("Tarifa "+tarifa[1].nombre+" por "+ diasT2+" Noches");
                        $('#_tarifa2').val(tarifa2);
                        $("#_ltarifa3").text("Tarifa 3 No Aplica");
                        $("#_ltarifa4").text("Tarifa 4 No Aplica");
                        subtotal=parseFloat(tarifa) + parseFloat(tarifa2);
                        $('#_subtotal').val(subtotal);
                        $('#_total').val(subtotal);
                        break;
                    case 3:
                        vaciarTarifas();
                        var fechafinT1=moment(tarifa[0].fecha_fin);
                        var fechaIniT2=moment(tarifa[1].fecha_ini);
                        var fechaFinT2=moment(tarifa[1].fecha_fin);
                        var fechaFin=moment(fecha_salida);
                        diasT1=fechafinT1.diff(fecha_entrada, 'days')+1;
                        diasT2=fechaFinT2.diff(fechaIniT2,'days')+1;
                        diasT3=fechaFin.diff(tarifa[1].fecha_fin,'days')-1;
                        tarifa1=diasT1*tarifa[0].precio;
                        tarifa2=diasT2*tarifa[1].precio;
                        tarifa3=diasT3*tarifa[2].precio;

                        $("#_ltarifa1").text("Tarifa "+tarifa[0].nombre+" por "+diasT1+" Noches");
                        $('#_tarifa1').val(tarifa1);
                        $("#_ltarifa2").text("Tarifa "+tarifa[1].nombre+" por "+ diasT2+" Noches");
                        $('#_tarifa2').val(tarifa2);
                        $("#_ltarifa3").text("Tarifa "+tarifa[2].nombre+" por "+ diasT3+" Noches");
                        $('#_tarifa3').val(tarifa3);
                        $("#_ltarifa4").text("Tarifa 4 No Aplica");
                        subtotal=parseFloat(tarifa1) + parseFloat(tarifa2)+parseFloat(tarifa3);
                        $('#_subtotal').val(subtotal);
                        $('#_total').val(subtotal);
                        break;
                     case 4:
                        vaciarTarifas();
                        var fechafinT1=moment(tarifa[0].fecha_fin);
                        var fechaIniT2=moment(tarifa[1].fecha_ini);
                        var fechaFinT2=moment(tarifa[1].fecha_fin);
                        var fechaIniT3=moment(tarifa[1].fecha_ini);
                        var fechaFinT3=moment(tarifa[1].fecha_fin);
                        var fechaFin=moment(fecha_salida);
                        diasT1=fechafinT1.diff(fecha_entrada, 'days')+1;
                        diasT2=fechaFinT2.diff(fechaIniT2,'days')+1;
                        diasT3=fechaFinT3.diff(fechaIniT3,'days')+1;
                        diasT4=fechaFin.diff(tarifa[2].fecha_fin,'days')-1;
                        tarifa1=diasT1*tarifa[0].precio;
                        tarifa2=diasT2*tarifa[1].precio;
                        tarifa3=diasT3*tarifa[2].precio;
                        tarifa4=diasT3*tarifa[3].precio

                        $("#_ltarifa1").text("Tarifa "+tarifa[0].nombre+" por "+diasT1+" Noches");
                        $('#_tarifa1').val(tarifa1);
                        $("#_ltarifa2").text("Tarifa "+tarifa[1].nombre+" por "+ diasT2+" Noches");
                        $('#_tarifa2').val(tarifa2);
                        $("#_ltarifa3").text("Tarifa "+tarifa[2].nombre+" por "+ diasT3+" Noches");
                        $('#_tarifa3').val(tarifa3);
                        $("#_ltarifa4").text("Tarifa "+tarifa[3].nombre+" por "+ diasT4+" Noches");
                        $('#_tarifa4').val(tarifa4);
                        subtotal=parseFloat(tarifa1) + parseFloat(tarifa2) + parseFloat(tarifa3) + parseFloat(tarifa4);
                        $('#_subtotal').val(subtotal);
                        $('#_total').val(subtotal);
                        break;
                    default:
                        break;
                }
            }


            function calcularNoches()
            {
                var entrada = moment(fecha_entrada);
                var salida = moment(fecha_salida);
                noches=salida.diff(entrada, 'days');
                $('#_noches').val(noches);
            }
            $( document ).ready(function()
            {
                //Calculo de noches en la reservación.
                calcularNoches();
            });


            $(document).on('click', '#_btnTarifa', function()
            {
                fecha_entrada=$('#reservacion-fecha_entrada').val();
                fecha_salida=$('#reservacion-fecha_salida').val();
                $.ajax({
                    data: {"fecha_entrada" : fecha_entrada, "fecha_salida" : fecha_salida, "origen" : $('#_origen').val(), "tipo" : tipo, "personas" :$('#_adultos').val() },
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo \yii\helpers\Url::to(['reservacion/obtener-tarifa'])?>",
                })
                .done(function( data, textStatus, jqXHR )
                {
                    tarifa = null;
                    var diasT1=diasT2=diasT3=diasT4=0;
                    tarifa = JSON.parse(data);
                    calculoTarifa(Object.keys(tarifa).length);
                    console.log(data);
                    if (Object.keys(tarifa).length<=0)
                    {
                        alert("NO SE TIENEN REGISTRADAS TARIFAS PARA EL ORIGEN "+$('#_origen').text() );

                    }

                })
                .fail(function( jqXHR, textStatus, errorThrown ) {
                    if ( console && console.log ) {
                        console.log( "La solicitud a fallado: " +  textStatus);
                    }
                });
            });

            $(document).on('click', '#_btnDisponible', function()
            {
                fecha_entrada=$('#reservacion-fecha_entrada').val();
                fecha_salida=$('#reservacion-fecha_salida').val();
                $.ajax({
                    data: {"fecha_entrada" : fecha_entrada, "fecha_salida" : fecha_salida },
                    type: "POST",
                    url: "<?php echo \yii\helpers\Url::to(['reservacion/habitaciones-disponibles'])?>",
                })
                .done(function( data, textStatus, jqXHR )
                {
                    //Codigo que agrega los habitaciones al select2
                    console.log(data);
                    $('#_id_habitacion').html(data);

                })
                .fail(function( jqXHR, textStatus, errorThrown ) {
                    if ( console && console.log ) {
                        console.log( "La solicitud a fallado: " +  textStatus);
                    }
                });
            });



</script>


<div class="reservacion-form">

<?php $form = ActiveForm::begin(); ?>
    <div class"row">
            <div class="col-md-6">
                <?php
                    echo '<label class="control-label">Select date range</label>';
                    echo DatePicker::widget([
                        'model' => $model,
                        'attribute' => 'fecha_entrada',
                        'attribute2' => 'fecha_salida',
                        'type' => DatePicker::TYPE_RANGE,
                        'language' => 'es',
                        'form' => $form,
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,
                        ],
                        'pluginEvents' => [
                            'changeDate' => "function(e) {
                                fecha_entrada=$('#reservacion-fecha_entrada').val();
                                fecha_salida=$('#reservacion-fecha_salida').val();
                                calcularNoches();
                             }",
                        ],
                    ]);
                ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'noches')->textInput(['id'=>'_noches','readonly'=>true]) ?>
            </div>
            <div class="col-md-3">
                <?php
                    $habitacion= new Habitacion();
                    echo $form->field($model, 'id_habitacion')->widget(Select2::classname(), [
                    'data'=>ArrayHelper::map(Habitacion::find()->where(['id'=>$model->id_habitacion])->all(),'id','descripcion'),
                    'options' => [
                        'id' =>'_id_habitacion',
                    ],
                ]);
                ?>
            </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <?= $form->field($model, 'ninos')->widget(TouchSpin::classname(), [
                        'options'=>[
                            'placeholder'=>'Cantidad de niños',
                            'value'=>0,
                        ],
                        'pluginOptions' => [
                            'max'=>4,
                            'verticalbuttons' => true,
                            'verticalupclass' => 'glyphicon glyphicon-plus',
                            'verticaldownclass' => 'glyphicon glyphicon-minus',
                        ]
                    ]);
                ?>
                <?= $form->field($model, 'adultos')->widget(TouchSpin::classname(), [
                        'options'=>[
                            'placeholder'=>'Cantidad de adultos',
                            'id'=>'_adultos',
                            'value'=>1,

                        ],
                        'pluginOptions' => [
                            'max'=>4,
                            'verticalbuttons' => true,
                            'verticalupclass' => 'glyphicon glyphicon-plus',
                            'verticaldownclass' => 'glyphicon glyphicon-minus',
                        ]
                    ]);
                ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'id_origen')->dropDownList(ArrayHelper::map(Origen::find()->all(), 'id', 'nombre'),['id'=>'_origen']);?>
                <?= $form->field($model, 'tipo')->dropDownList(['0' => 'Remisión', '1' => 'Factura']);?>
            </div>
            <div class="col-md-4">
                <?php
                    $url = \yii\helpers\Url::to(['huespedes']);
                    echo $form->field($model, 'id_huesped')->widget(Select2::classname(), [
                    'options' => ['placeholder' => 'Buscar Huesped ...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'minimumInputLength' => 3,
                        'language' => [
                            'errorLoading' => new JsExpression("function () { return 'Esperando resultados...'; }"),
                        ],
                        'ajax' => [
                            'url' => $url,
                            'dataType' => 'json',
                            'data' => new JsExpression('function(params) { return {q:params.term}; }')
                        ],
                        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                        'templateResult' => new JsExpression('function(nombre) { return nombre.text; }'),
                        'templateSelection' => new JsExpression('function (nombre) { return nombre.text; }'),
                    ],
                ]);?>

                <?php echo Html::a('<span class="glyphicon glyphicon-plus">Nuevo Huesped</span>',
                        ['/huesped/create'],
                        [
                            'title' => 'Agregar Huesped',
                            'target' => '_blank',
                        ]
                    );
                ?>
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'notas')->textArea(['maxlength' => true]) ?>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-large btn-warning" id="_btnDisponible">Comprobar Disponibilidad</button>

            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-large btn-success" id="_btnTarifa">Obtener Tarifa y Totales</button>
            </div>
    </div>
    <div class="row">
        <div class="col-md-6">
                <?= $form->field($model, 'tarifa1')->textInput(['id'=>'_tarifa1','value'=>0,'readonly'=>true])->label('Tarifa 1',['class'=>'label-class','id'=>'_ltarifa1']) ?>
                <?= $form->field($model, 'tarifa2')->textInput(['id'=>'_tarifa2','value'=>0,'readonly'=>true])->label('Tarifa 2',['class'=>'label-class','id'=>'_ltarifa2']) ?>
                <?= $form->field($model, 'tarifa3')->textInput(['id'=>'_tarifa3','value'=>0,'readonly'=>true])->label('Tarifa 3',['class'=>'label-class','id'=>'_ltarifa3']) ?>
                <?= $form->field($model, 'tarifa4')->textInput(['id'=>'_tarifa4','value'=>0,'readonly'=>true])->label('Tarifa 4',['class'=>'label-class','id'=>'_ltarifa4']) ?>
        </div>
        <div class="col-md-6">
                <?= $form->field($model, 'subtotal')->textInput(['id'=>'_subtotal','readonly'=>true]) ?>
                <?= $form->field($model, 'descuento')->widget(Select2::classname(), [
                    'data'=>$model->obtenerDescuentos(),
                    'options' => [
                        'id' =>'_descuento',
                    ],
                    'pluginOptions' => [
                        'placeholder' => 'Selecciona algun descuento',
                    ],
                    'pluginEvents' => [
                        "change" => "function() {
                                subtotal=parseFloat($('#_subtotal').val());
                                descuento=0;
                                console.log($('#_descuento').val());
                                switch ($('#_descuento').val()) {
                                     case '0':
                                        $('#_total').val(subtotal);
                                        break;
                                    case '1':
                                        descuento=subtotal*.05;
                                        $('#_total').val(subtotal-descuento);
                                        break;
                                    case '2':
                                        descuento=subtotal*.10;
                                        $('#_total').val(subtotal-descuento);
                                        break;
                                    case '3':
                                        descuento=subtotal*.15;
                                        $('#_total').val(subtotal-descuento);
                                        break;
                                    case '4':
                                        descuento=subtotal*.20;
                                        $('#_total').val(subtotal-descuento);
                                        break;
                                    case '5':
                                        descuento=subtotal*.50;
                                        $('#_total').val(subtotal-descuento);
                                        break;
                                    case '6':
                                        descuento=subtotal;
                                        $('#_total').val(subtotal-descuento);
                                        break;
                                    default:
                                        break;
                                }

                        }",
                    ],
                ]);
               ?>
                <?= $form->field($model, 'total')->textInput(['id'=>'_total','readonly'=>true]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
