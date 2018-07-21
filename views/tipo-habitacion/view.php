<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\editable\Editable;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\TipoHabitacion */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Habitaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-habitacion-view">
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
                    'id',
                    'descripcion',
                ]
            ]);

        ?>
        </div>

</div>
