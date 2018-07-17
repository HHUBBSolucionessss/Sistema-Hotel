<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use kartik\detail\DetailView;
use kartik\editable\Editable;

use app\models\TarifaDetalladaSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Tarifa */

?>
<div class="tarifa-view">
    <div class="col-md-6">
            <?php
            echo DetailView::widget([
                'model'=>$model,
                'condensed'=>true,
                'hover'=>true,
                'mode'=>DetailView::MODE_VIEW,
                'panel'=>[
                    'heading'=>'Tarifa </br>' . $model->nombre,
                    'type'=>DetailView::TYPE_INFO,
                ],
                'buttons1' => '{view}',
                'attributes'=>
                [
                    'id',
                    'nombre',
                    [
                        'attribute'=>'fecha_ini',
                        'format'=>'date',
                        'value'=>$model->fecha_ini,
                        'displayOnly'=>true,
                    ],
                    [
                        'attribute'=>'fecha_fin',
                        'format'=>'date',
                        'value'=>$model->fecha_fin,
                        'displayOnly'=>true,
                    ],
                    [
                        'attribute'=>'create_user',
                        'format'=>'raw',
                        'value'=>$model->create_user,
                        'displayOnly'=>true,
                    ],
                    [
                        'attribute'=>'create_time',
                        'format'=>'date',
                        'value'=>$model->create_time,
                        'displayOnly'=>true,
                    ],
                     
                    [
                        'attribute'=>'update_user',
                        'format'=>'raw',
                        'value'=>$model->update_user,
                        'displayOnly'=>true,
                    ],   
                    [
                        'attribute'=>'update_time',
                        'format'=>'date',
                        'value'=>$model->update_time,
                        'displayOnly'=>true,
                    ],                

                ]
            ]);

        ?>
    </div>
    <div class="col-md-6">
         <?php   
            $searchModel = new TarifaDetalladaSearch();
            $dataProvider = $searchModel->buscarPrecios($model->id);
            $gridColumns = [
                ['class' => 'kartik\grid\SerialColumn'],
                [
                    'attribute' => 'adultos',
                    'vAlign'=>'middle',
                    'headerOptions'=>['class'=>'kv-sticky-column'],
                    'contentOptions'=>['class'=>'kv-sticky-column'],
                ],
                [
                    'attribute' => 'precio',
                    'vAlign'=>'middle',
                    'headerOptions'=>['class'=>'kv-sticky-column'],
                    'contentOptions'=>['class'=>'kv-sticky-column'],
                ]

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
                'showPageSummary' => true,
                'panel' => [
                    'heading'=>'Precios',
                    'type' => GridView::TYPE_PRIMARY
                ],
            ]);

        ?>
    </div>
 



</div>
