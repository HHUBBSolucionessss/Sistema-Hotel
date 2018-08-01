<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use app\models\User;

use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CajaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Caja';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="caja-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Movimientos de caja', ['value'=>Url::to('../caja/create'), 'class' => 'btn btn-info', 'id' => 'modalButton']) ?>
    </p>
    <p>
        <?= Html::button('Apertura Caja', ['value'=>Url::to('../caja/apertura'), 'class' => 'btn btn-success', 'id' => '_modalButtonApertura']) ?>
    </p>
    <p>
        <?= Html::button('Cierre de caja', ['value'=>Url::to('../caja/cierre'), 'class' => 'btn btn-danger', 'id' => '_modalButtonCierre']) ?>
    </p>

    <?php
      Modal::begin([
        'header' => '<h4 style="color:#337AB7";>Movimientos de Caja</h4>',
        'id' => 'modal',
        'size' => 'modal-lg',
      ]);

      echo "<div id='modalContent'></div>";

      Modal::end();
    ?>
    <?php
      Modal::begin([
        'header' => '<h4 style="color:#337AB7";>Apertura de caja</h4>',
        'id' => '_modalApertura',
        'size' => 'modal-md',
      ]);

      echo "<div id='_aperturaCaja'></div>";

      Modal::end();
    ?>
    <?php
      Modal::begin([
        'header' => '<h4 style="color:#337AB7";>Cierre de caja</h4>',
        'id' => '_modalCierre',
        'size' => 'modal-md',
      ]);

      echo "<div id='_cierraCaja'></div>";

      Modal::end();
    ?>

<?php Pjax::begin(); ?>
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
                  'attribute'=>'tipo_movimiento',
                  'vAlign'=>'middle',
                  'value'=>function ($model, $key, $index) {
                      return $model->obtenerTipoMovimiento($model->tipo_movimiento);
                    },
                    'filterType'=>GridView::FILTER_SELECT2,
                    'filter'=> ['0' => 'Entrada', '1' => 'Salida'],
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                    'filterInputOptions'=>['placeholder'=>'Tipo Movimiento...'],
                    'format'=>'raw'
                ],
                [
                  'attribute'=>'tipo_pago',
                  'vAlign'=>'middle',
                  'value'=>function ($model, $key, $index) {
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
                [
                    'attribute' => 'create_time',
                    'vAlign'=>'middle',
                    'headerOptions'=>['class'=>'kv-sticky-column'],
                    'contentOptions'=>['class'=>'kv-sticky-column'],
                ],
                [
                    'attribute'=>'create_user',
                    'vAlign'=>'middle',
                    'value'=>function ($model, $key, $index) {
                        $usuario= new User();
                        return $usuario->obtenerNombre($model->create_user);
                    },
                    'format'=>'raw'
                ],
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'template'=>'{delete}',
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
                       'filename' => 'exportacion-caja',
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
