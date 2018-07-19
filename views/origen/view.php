<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\editable\Editable;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Origen */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orígenes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="origen-view">

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
                    [
                        'attribute'=>'create_time',
                        'format'=>'date',
                        'value'=>$model->create_time,
                        'displayOnly'=>true,
                    ],
                    [
                        'attribute'=>'create_user',
                        'format'=>'raw',
                        'value'=>$model->create_user,
                        'displayOnly'=>true,
                    ],
                    [
                        'attribute'=>'update_time',
                        'format'=>'date',
                        'value'=>$model->update_time,
                        'displayOnly'=>true,
                    ],
                    [
                        'attribute'=>'update_user',
                        'format'=>'raw',
                        'value'=>$model->update_user,
                        'displayOnly'=>true,
                    ],

                ]
            ]);

        ?>
        </div>

</div>
