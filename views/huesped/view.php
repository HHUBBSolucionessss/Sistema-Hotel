<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\editable\Editable;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Huesped */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Huespeds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="huesped-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="col-md-6">
        <?php
            echo DetailView::widget([
                'model'=>$model,
                'condensed'=>true,
                'hover'=>true,
                'mode'=>DetailView::MODE_VIEW,
                'panel'=>[
                    'heading'=>'Huesped </br>' . $model->nombre,
                    'type'=>DetailView::TYPE_INFO,
                ],
                'attributes'=>
                [
                    'nombre',
                    'email:email',
                    'calle',
                    'ciudad',
                    'colonia',
                    'estado',
                    'pais',
                    'cp',
                    'telefono',
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
