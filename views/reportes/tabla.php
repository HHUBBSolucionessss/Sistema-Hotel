<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\widgets\Pjax;

use app\models\Habitacion;
use app\models\Huesped;
use app\models\Origen;
use app\models\Reservacion;

use kartik\dynagrid\DynaGrid;

/* @var $this yii\web\View */
/* @var $model app\models\Caja */

?>
<div class="reportes-form">
        <?php $form = ActiveForm::begin(); ?>
        <div   class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>



        <?php
        $columns = [
            ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
            'id',
            [
                'attribute'=>'fecha_entrada',
                'filterType'=>GridView::FILTER_DATE,
                'format'=>'raw',
                'width'=>'170px',
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['format'=>'yyyy-mm-dd']
                ],
            ],
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'status',
                'vAlign'=>'middle',
            ],
            [
                'class'=>'kartik\grid\ActionColumn',
                'dropdown'=>false,
                'order'=>DynaGrid::ORDER_FIX_RIGHT
            ],
            ['class'=>'kartik\grid\CheckboxColumn', 'order'=>DynaGrid::ORDER_FIX_RIGHT],
          ];

          echo DynaGrid::widget([
            'columns'=>$columns,
            'storage'=>DynaGrid::TYPE_COOKIE,
            'theme'=>'panel-danger',
            'gridOptions'=>[
                'dataProvider'=>$dataProvider,
                'filterModel'=>$searchModel,
                'panel'=>['heading'=>'<h3 class="panel-title">Library</h3>'],
            ],
            'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
          ]);
            ?>

</div>
