<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

use app\models\Habitacion;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ReservacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reservacions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservacion-index">
    <?php Pjax::begin(); ?>
    <?php
            $fecha_e=$fecha_entrada;
            $fecha_s=$fecha_salida;
            $gridColumns = [
                ['class' => 'kartik\grid\SerialColumn'],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'id',
                    'vAlign'=>'middle',
                    'headerOptions'=>['class'=>'kv-sticky-column'],
                    'contentOptions'=>['class'=>'kv-sticky-column'],
                    'visible' => false,
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'descripcion',
                    'vAlign'=>'middle',
                    'headerOptions'=>['class'=>'kv-sticky-column'],
                    'contentOptions'=>['class'=>'kv-sticky-column'],
                ],

                [
                    'attribute' => 'tipo_habitacion',
                    'vAlign'=>'middle',
                    'value'=>function ($model, $key, $index, $widget) { 
                        $habitacion= new Habitacion();
                        return $habitacion->obtenerTipoHabitacion($model['tipo_habitacion']);
                    },
                    'headerOptions'=>['class'=>'kv-sticky-column'],
                    'contentOptions'=>['class'=>'kv-sticky-column'],
                ],
                [
                    'format' => 'raw',
                    'vAlign' => 'middle',
                    'width' => '180px',
                    'value' => function($model, $key, $index, $widget) use ($fecha_entrada, $fecha_salida)
                    { 
                        return Html::a('<span class="glyphicon glyphicon-plus"></span> Crear Reservación', Url::to(['reservacion/nueva']), 
                        [
                            'data' => [
                                'confirm' => "¿Deseas crear una reservacion en esta habitacion?",
                                'method' => 'POST',
                                'params'=>['id_habitacion'=>$model['id'],'fecha_entrada'=>$fecha_entrada,'fecha_salida'=>$fecha_salida,'tipo_habitacion'=>$model['tipo_habitacion']],

                            ],
                        ]);
                    },

                ],
            ];

            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns,
                'containerOptions' => ['style'=>'overflow: false'], // only set when $responsive = false
                'pjax' => true,
                'bordered' => true,
                'striped' => false,
                'condensed' => false,
                'responsive' => true,
                'hover' => true,
                'floatHeader' => false,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY
                ],
            ]);

        ?>  
    <?php Pjax::end(); ?>
</div>
