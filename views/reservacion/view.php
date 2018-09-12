<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\detail\DetailView;


use app\models\Habitacion;
use app\models\Huesped;
use app\models\Caja;
use app\models\User;
use app\models\Origen;

/* @var $this yii\web\View */
/* @var $model app\models\Reservacion */

$this->title = 'Reservación con Folio '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Reservaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?php
        if($model->saldo > 0 && $privilegio[0]['realizar_pago'] == 1)
        echo Html::a('Realizar Pago', ['pago-reservacion','id'=>$model->id], ['class' => 'btn btn-info', 'id'=>'_Pago']) ?>
</p>
<p>
  <?php
  if($privilegio[0]['modificar_reservacion'] == 1)
  echo Html::a('Modificar reservación', ['update','id'=>$model->id], ['class' => 'btn btn-success', 'id'=>'_Pago']) ?>
        <?= Html::a('Generar PDF', ['reservacion/info', 'id'=>$model->id], ['class'=>'btn', 'target'=>'_blank']) ?>
</p>

<div class="reservacion-view">
    <div class="col-md-6">
                <?php
            $habitacion= new Habitacion();
            $origen= new Origen();
            $huesped= new Huesped();
            $user= new User();
            echo DetailView::widget([
                    'model'=>$model,
                    'condensed'=>true,
                    'hover'=>true,
                    'mode'=>DetailView::MODE_VIEW,
                    'panel'=>[
                        'heading'=>'Vista Reservación',
                        'type'=>DetailView::TYPE_INFO,
                    ],
                    'attributes'=>
                    [
                        [
                          'attribute'=>'id',
                          'format'=>'raw',
                          'label'=>'Folio',
                          'displayOnly'=>true,
                        ],
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
                        [
                          'attribute'=>'fecha_entrada',
                          'displayOnly'=>true,
                        ],
                        [
                          'attribute'=>'fecha_salida',
                          'displayOnly'=>true,
                        ],
                        [
                          'attribute'=>'notas',
                          'displayOnly'=>true,
                        ],
                        [
                          'attribute'=>'adultos',
                          'displayOnly'=>true,
                        ],
                        [
                          'attribute'=>'ninos',
                          'displayOnly'=>true,
                        ],
                        [
                          'attribute'=>'noches',
                          'displayOnly'=>true,
                        ],
                        [
                          'attribute'=>'status',
                          'format'=>'raw',
                          'value'=>$model->obtenerEstado($model->status),
                          'displayOnly'=>true,
                        ],

                        [
                            'attribute'=>'estado_pago',
                            'label'=>'Estado Pago',
                            'displayOnly'=>true,
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
                            'displayOnly'=>true,
                            'value'=>  $model->obtenerComprobante($model->tipo),
                            'type'=>DetailView::INPUT_SELECT2,
                            'widgetOptions'=>[
                                'data'=>[0=> 'REMISION',1=> 'FACTURACION'],
                                'options' => ['placeholder' => 'Selecciona una opción'],
                                'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
                            ],
                        ],
                        [
                          'attribute'=>'saldo',
                          'displayOnly'=>true,
                        ],
                        [
                          'attribute'=>'subtotal',
                          'displayOnly'=>true,
                        ],
                        [
                          'attribute'=>'descuento',
                          'displayOnly'=>true,
                        ],
                        [
                          'attribute'=>'total',
                          'displayOnly'=>true,
                        ],
                        [
                            'attribute'=>'create_user',
                            'format'=>'raw',
                            'value'=>$user->obtenerNombre($model->create_user),
                            'displayOnly'=>true,
                        ],
                        [
                            'attribute'=>'create_time',
                            'format'=>'date',
                            'value'=>$model->create_time,
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
                  'attribute'=>'tipo_pago',
                  'vAlign'=>'middle',
                  'value'=>function ($model, $key, $index, $widget) {
                      $model=new Caja();
                      return $model->obtenerTipoPago($model->tipo_pago);
                    },
                    'filterType'=>GridView::FILTER_SELECT2,
                    'filter'=> ['0' => 'Entrada', '1' => 'Salida'],
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                    'filterInputOptions'=>['placeholder'=>'Tipo Pago...'],
                    'format'=>'raw'
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
                    'export' => false,
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
