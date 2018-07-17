<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\detail\DetailView;


use app\models\Habitacion;
use app\models\Huesped;
use app\models\Origen;

/* @var $this yii\web\View */
/* @var $model app\models\Reservacion */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Reservacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>




<p>
    <?php
        if($model->saldo>0)
        echo Html::a('Realizar Pago', ['pago-reservacion','id'=>$model->id], ['class' => 'btn btn-info', 'id'=>'_Pago']) ?>
</p>
<p>
    <?php
        echo Html::a('Modificar Reservacion', ['update','id'=>$model->id], ['class' => 'btn btn-success', 'id'=>'_Pago']) ?>
</p>

<div class="reservacion-view">
    <div class="col-md-6">
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
    <div class="col-md-6">

        <?php
                $gridColumns = [
                    [
                        'class' => 'kartik\grid\SerialColumn',
                        'contentOptions' => ['class' => 'kartik-sheet-style'],
                        'width' => '36px',
                        'header' => '',
                        'headerOptions' => ['class' => 'kartik-sheet-style']
                    ],
                    [
                        'attribute' => 'id_reservacion',
                        'vAlign'=>'middle',
                        'headerOptions'=>['class'=>'kv-sticky-column'],
                        'contentOptions'=>['class'=>'kv-sticky-column'],
                    ],
                    [
                        'attribute' => 'efectivo',
                        'vAlign'=>'middle',
                        'headerOptions'=>['class'=>'kv-sticky-column'],
                        'contentOptions'=>['class'=>'kv-sticky-column'],
                    ],
                    [
                        'attribute' => 'tarjeta',
                        'vAlign'=>'middle',
                        'headerOptions'=>['class'=>'kv-sticky-column'],
                        'contentOptions'=>['class'=>'kv-sticky-column'],
                    ],
                    [
                        'attribute' => 'deposito',
                        'vAlign'=>'middle',
                        'headerOptions'=>['class'=>'kv-sticky-column'],
                        'contentOptions'=>['class'=>'kv-sticky-column'],
                    ],
                    [
                        'attribute' => 'tipo_pago',
                        'vAlign'=>'middle',
                        'headerOptions'=>['class'=>'kv-sticky-column'],
                        'contentOptions'=>['class'=>'kv-sticky-column'],
                    ],
                ];

                echo GridView::widget([
                    
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns,
                    'containerOptions' => ['style'=>'overflow: false'], // only set when $responsive = false
                    'beforeHeader'=>[
                        [
                            'options'=>['class'=>'skip-export'] // remove this row from export
                        ]
                    ],
                    'toolbar' =>  [
                        '{export}',
                        '{toggleData}'
                    ],
                    'pjax' => true,
                    'bordered' => true,
                    'striped' => false,
                    'condensed' => false,
                    'responsive' => true,
                    'hover' => true,
                    'floatHeader' => false,
                    'showPageSummary' => true,
                    'panel' => [
                        'type' => GridView::TYPE_PRIMARY
                    ],
                ]);
            ?>  
    </div>


</div>
