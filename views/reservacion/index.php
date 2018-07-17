<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;


use app\models\Habitacion;
use app\models\Huesped;
use app\models\Origen;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReservacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reservacions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

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
                    'class' => 'kartik\grid\ExpandRowColumn',
                    'width' => '50px',
                    'value' => function ($model, $key, $index, $column) {
                        return GridView::ROW_COLLAPSED;
                    },
                    'detail' => function ($model, $key, $index, $column) {
                        return Yii::$app->controller->renderPartial('ver_reservacion', ['model' => $model]);
                    },
                    'headerOptions' => ['class' => 'kartik-sheet-style'], 
                    'expandOneOnly' => true
                ],
                [
                    'attribute' => 'id',
                    'vAlign'=>'middle',
                    'headerOptions'=>['class'=>'kv-sticky-column'],
                    'contentOptions'=>['class'=>'kv-sticky-column'],
                ],
                [
                    'attribute'=>'id_habitacion', 
                    'vAlign'=>'middle',
                    'value'=>function ($model, $key, $index, $widget) {
                        $habitacion= new Habitacion(); 
                        return $habitacion->obtenerDescripcion($model->id_habitacion);
                    },
                    'format'=>'raw'
                ],
                [
                    'attribute'=>'id_huesped', 
                    'vAlign'=>'middle',
                    'value'=>function ($model, $key, $index, $widget) {
                        $huesped= new Huesped(); 
                        return $huesped->obtenerNombre($model->id_huesped);
                    },
                    'format'=>'raw'
                ],
                [
                    'attribute' => 'fecha_entrada',
                    'vAlign'=>'middle',
                    'headerOptions'=>['class'=>'kv-sticky-column'],
                    'contentOptions'=>['class'=>'kv-sticky-column'],
                ],
                [
                    'attribute' => 'fecha_salida',
                    'vAlign'=>'middle',
                    'headerOptions'=>['class'=>'kv-sticky-column'],
                    'contentOptions'=>['class'=>'kv-sticky-column'],
                ],
                [
                    'attribute' => 'noches',
                    'vAlign'=>'middle',
                    'headerOptions'=>['class'=>'kv-sticky-column'],
                    'contentOptions'=>['class'=>'kv-sticky-column'],
                ],
                [
                    'attribute'=>'status', 
                    'vAlign'=>'middle',
                    'value'=>function ($model, $key, $index, $widget) { 
                        return $model->obtenerEstado($model->status);
                    },
                    'format'=>'raw'
                ],
                [
                    'attribute' => 'total',
                    'vAlign'=>'middle',
                    'headerOptions'=>['class'=>'kv-sticky-column'],
                    'contentOptions'=>['class'=>'kv-sticky-column'],
                ],
                [
                    'attribute' => 'saldo',
                    'vAlign'=>'middle',
                    'headerOptions'=>['class'=>'kv-sticky-column'],
                    'contentOptions'=>['class'=>'kv-sticky-column'],
                ],
                [
                    'attribute'=>'id_origen', 
                    'vAlign'=>'middle',
                    'value'=>function ($model, $key, $index, $widget) {
                        $origen=new Origen(); 
                        return $origen->obtenerOrigen($model->id_origen);
                    },
                    'filterType'=>GridView::FILTER_SELECT2,
                    'filter'=>ArrayHelper::map(Origen::find()->all(), 'id', 'nombre'), 
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                    'filterInputOptions'=>['placeholder'=>'Origen...'],
                    'format'=>'raw'
                ],

                [
                    'class' => 'kartik\grid\ActionColumn',
                    'template'=>'{view}{delete}',
                    'vAlign'=>'middle',

                ],
            ];

            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
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
    <?php Pjax::end(); ?>
</div>
