<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use app\models\Caja;
use app\models\User;

use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CajaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Corte de caja';
?>
<div class="caja-index">


    <?php $form = ActiveForm::begin(); ?>

    <p>Efectivo: $<?=$efectivo?></p>
    <p>Tarjeta: $<?=$tarjeta?></p>
    <p>Depósito: $<?=$deposito?></p>

    <p>Reservaciones terminadas: <?=$terminada?></p>
    <p>Reservaciones creadas: <?=$creada?></p>
    <p>Reservaciones en uso: <?=$uso?></p>
    <br>
    <?php ActiveForm::end(); ?>

    <?php Pjax::begin(); ?>
            <?php
                $gridColumns = [
                  [
                      'attribute' => 'id',
                      'label' => 'Folio',
                  ],
                  [
                      'attribute' => 'descripcion',
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
                      'attribute'=>'create_user',
                      'vAlign'=>'middle',
                      'value'=>function ($model, $key, $index) {
                          $usuario= new User();
                          return $usuario->obtenerNombre($model->create_user);
                      },
                      'format'=>'raw'
                  ],
                ];

                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns,
                ]);

            ?>




        <?php Pjax::end(); ?>

</div>
