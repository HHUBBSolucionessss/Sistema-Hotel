<?php

use yii\helpers\Html;
use kartik\detail\DetailView;


use app\models\Habitacion;
use app\models\Huesped;
use app\models\Origen;

/* @var $this yii\web\View */
/* @var $model app\models\Reservacion */

?>
<div class="reservacion-view">
        <?php 
            $habitacion= new Habitacion();
            $origen= new Origen();
            $huesped= new Huesped();
            echo DetailView::widget([
                    'model'=>$model,
                    'condensed'=>true,
                    'hover'=>true,
                    'mode'=>DetailView::MODE_VIEW,
                    'panel'=>[
                        'heading'=>'RESERVACION  </br>FOLIO'. $model->id,
                        'type'=>DetailView::TYPE_INFO,
                    ],
                    'buttons1' => '{view}',
                    'attributes'=>
                    [
                        [
                            'attribute'=>'id_habitacion',
                            'format'=>'raw',
                            'value'=>$habitacion->obtenerDescripcion($model->id_habitacion),
                            'displayOnly'=>true,
                        ],
                        [
                            'attribute'=>'id_origen',
                            'format'=>'raw',
                            'value'=>$origen->obtenerOrigen($model->id_origen),
                            'displayOnly'=>true,
                        ],
                        [
                            'attribute'=>'id_huesped',
                            'format'=>'raw',
                            'value'=>$huesped->obtenerNombre($model->id_huesped),
                            'displayOnly'=>true,
                        ],
                        [
                            'attribute'=>'telefono',
                            'format'=>'raw',
                            'value'=>$huesped->obtenerTelefono($model->id_huesped),
                            'displayOnly'=>true,
                        ],
                        'fecha_entrada',
                        'fecha_salida',
                        'notas',
                        'adultos',
                        'ninos',
                        'noches',
                        'status',
                        [
                            'attribute'=>'estado_pago', 
                            'label'=>'Pagada?',
                            'format'=>'raw',
                            'value'=>$model->estado_pago ? '<span class="label label-success">Pagada</span>' : '<span class="label label-danger">No Pagada</span>',
                            'type'=>DetailView::INPUT_SWITCH,
                            'widgetOptions' => 
                            [
                                'pluginOptions' => 
                                [
                                    'onText' => 'SI',
                                    'offText' => 'NO',
                                ]
                            ],
                        ],
                        [
                            'attribute'=>'tipo', 
                            'label'=>'Tipo Comprobante',
                            'format'=>'raw',
                            'value'=>  $model->obtenerComprobante($model->tipo),
                            'type'=>DetailView::INPUT_SELECT2, 
                            'widgetOptions'=>[
                                'data'=>[0=> 'REMISION',1=> 'FACTURACION'],
                                'options' => ['placeholder' => 'Selecciona una opción'],
                                'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
                            ],
                        ],
                        'saldo',
                        'subtotal',
                        'descuento',
                        'total',
                        [
                            'attribute'=>'create_time',
                            'format'=>'date',
                            'value'=>$model->create_time,
                            'displayOnly'=>true,
                        ],
                        [
                            'attribute'=>'create_user',
                            'format'=>'raw',
                            'value'=>$model->create_user,
                            'displayOnly'=>true,
                        ],
                        [
                            'attribute'=>'update_time',
                            'format'=>'date',
                            'value'=>$model->update_time,
                            'displayOnly'=>true,
                        ],
                        [
                            'attribute'=>'update_user',
                            'format'=>'raw',
                            'value'=>$model->update_user,
                            'displayOnly'=>true,
                        ],
                    ]
                ]);

            ?>                  
</div>
