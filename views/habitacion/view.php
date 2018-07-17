<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\editable\Editable;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use app\models\TipoHabitacion;

/* @var $this yii\web\View */
/* @var $model app\models\Habitacion */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Habitacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="habitacion-view">

    <h1><?= Html::encode($this->title) ?></h1>


<div class="row">
        <div class="col-md-6">
        <?php
            echo DetailView::widget([
                'model'=>$model,
                'condensed'=>true,
                'hover'=>true,
                'mode'=>DetailView::MODE_VIEW,
                'panel'=>[
                    'heading'=>'Habitacion </br>' . $model->descripcion,
                    'type'=>DetailView::TYPE_INFO,
                ],
                'attributes'=>
                [
                    'descripcion',
                    [
                        'attribute'=>'tipo_habitacion', 
                        'format'=>'raw',
                        'value'=>  $model->obtenerTipoHabitacion($model->tipo_habitacion),
                        'type'=>DetailView::INPUT_SELECT2, 
                        'widgetOptions'=>[
                            'data'=>ArrayHelper::map(TipoHabitacion::find()->all(), 'id', 'descripcion'),                            
                            'options' => ['placeholder' => 'Selecciona una opción'],
                            'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
                        ],
                    ],
                    [
                        'attribute'=>'status', 
                        'label'=>'Activa?',
                        'format'=>'raw',
                        'value'=>$model->status ? '<span class="label label-success">Activa </span>' : '<span class="label label-danger">Inactiva</span>',
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
                    'capacidad',
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





</div>
