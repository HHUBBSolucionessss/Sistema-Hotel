<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoHabitacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo de Habitaciones';
$this->params['breadcrumbs'][] = ['label' => 'Habitaciones', 'url' => ['habitacion/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-habitacion-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::button('Crear tipo de habitación', ['value'=>Url::to('../tipo-habitacion/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
    </p>

    <?php
      Modal::begin([
        'header' => '<h4 style="color:#337AB7";>Crear Tipo de Habitación</h4>',
        'id' => 'modal',
        'size' => 'modal-lg',
      ]);

      echo "<div id='modalContent'></div>";

      Modal::end();
    ?>

    <?php
            $gridColumns = [
                ['class' => 'kartik\grid\SerialColumn'],
                [
                    'attribute' => 'descripcion',
                    'vAlign'=>'middle',
                    'headerOptions'=>['class'=>'kv-sticky-column'],
                    'contentOptions'=>['class'=>'kv-sticky-column'],
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
                'exportConfig' => [
                   GridView::EXCEL => [
                       'label' => 'Exportar a Excel',
                       'iconOptions' => ['class' => 'text-success'],
                       'showHeader' => true,
                       'showPageSummary' => true,
                       'showFooter' => true,
                       'showCaption' => true,
                       'filename' => 'exportacion-tipo-habitacion',
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
