<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;

use app\models\Habitacion;
use app\models\TipoHabitacion;
use app\models\Origen;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TarifaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tarifas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tarifa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear tarifa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
            $gridColumns = [
                ['class' => 'kartik\grid\SerialColumn'],
                [
                    'class' => 'kartik\grid\ExpandRowColumn',
                    'width' => '50px',
                    'value' => function ($model, $key, $index, $column) {
                        return GridView::ROW_COLLAPSED;
                    },
                    'detail' => function ($model, $key, $index, $column) {
                        return Yii::$app->controller->renderPartial('view',['model' => $model]);
                    },
                    'headerOptions' => ['class' => 'kartik-sheet-style'],
                    'expandOneOnly' => true
                ],
                [
                    'attribute' => 'nombre',
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
                    'attribute'=>'id_tipo_habitacion',
                    'vAlign'=>'middle',
                    'value'=>function ($model, $key, $index, $widget) {
                        $habitacion = new Habitacion();
                        return $habitacion->obtenerTipoHabitacion($model->id_tipo_habitacion);
                    },
                    'filterType'=>GridView::FILTER_SELECT2,
                    'filter'=>ArrayHelper::map(TipoHabitacion::find()->all(), 'id', 'descripcion'),
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                    'filterInputOptions'=>['placeholder'=>'Tipo Habitacion...'],
                    'format'=>'raw'
                ],
                [
                    'attribute' => 'fecha_ini',
                    'vAlign'=>'middle',
                    'headerOptions'=>['class'=>'kv-sticky-column'],
                    'contentOptions'=>['class'=>'kv-sticky-column'],
                ],
                [
                    'attribute' => 'fecha_fin',
                    'vAlign'=>'middle',
                    'headerOptions'=>['class'=>'kv-sticky-column'],
                    'contentOptions'=>['class'=>'kv-sticky-column'],
                ],
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'template'=>'{view} {delete}',
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
                'exportConfig' => [
                   GridView::EXCEL => [
                       'label' => 'Exportar a Excel',
                       'iconOptions' => ['class' => 'text-success'],
                       'showHeader' => true,
                       'showPageSummary' => true,
                       'showFooter' => true,
                       'showCaption' => true,
                       'filename' => 'exportacion-tarifa',
                       'alertMsg' => 'The EXCEL export file will be generated for download.',
                       'options' => ['title' => 'Microsoft Excel 95+'],
                       'mime' => 'application/vnd.ms-excel',
                       'config' => [
                       'worksheet' => 'ExportWorksheet',
                           'cssFile' => ''
                       ]
                   ],
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
