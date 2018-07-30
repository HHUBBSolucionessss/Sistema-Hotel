<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use app\models\User;
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
        $user= new User();
            echo DetailView::widget([
                'model'=>$model,
                'condensed'=>true,
                'hover'=>true,
                'mode'=>DetailView::MODE_VIEW,
                'panel'=>[
                    'heading'=>'Huésped </br>' . $model->nombre,
                    'type'=>DetailView::TYPE_INFO,
                ],
                'attributes'=>
                [
                    [
                      'attribute'=>'id',
                      'format'=>'raw',
                      'label'=>'ID',
                      'displayOnly'=>true,
                    ],
                    'nombre',
                    [
                        'attribute'=>'create_user',
                        'format'=>'raw',
                        'value'=>$user->obtenerNombre($model->create_user),
                        'displayOnly'=>true,
                    ],
                    [
                        'attribute'=>'create_time',
                        'format'=>'date',
                        'value'=>$model->create_time,
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
