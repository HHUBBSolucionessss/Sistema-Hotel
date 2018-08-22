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

$this->title = 'Reporte de reservación del huésped'.$model->nombre;?>

<h1>Reporte de reservación</h1>
<br><br>

<div class="reservacion-info">
    <div class="col-md-6">
        <?php
            $habitacion= new Habitacion();
            $origen= new Origen();
            $huesped= new Huesped();
            $user= new User();


            echo DetailView::widget([
                    'model'=>$model,
                    'panel'=>[
                        'heading'=>'',
                    ],
                    'attributes'=>
                    [
                        [
                          'attribute'=>'id',
                          'format'=>'raw',
                          'label'=>'ID',
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
                        'fecha_entrada',
                        'fecha_salida',
                        'notas',
                        'adultos',
                        'ninos',
                        'noches',
                        [
                            'attribute'=>'status',
                            'format'=>'raw',
                            'value'=>$model->obtenerEstado($model->status),
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
                        [
                            'attribute'=>'update_time',
                            'format'=>'date',
                            'label'=>'Actualizado el',
                            'value'=>$model->update_time,
                            'displayOnly'=>true,
                        ],
                        [
                            'attribute'=>'update_user',
                            'label'=>'Actualizó',
                            'format'=>'raw',
                            'value'=>$model->update_user,
                            'displayOnly'=>true,
                        ],
                    ]
                ]);

            ?>
    </div>
</div>
