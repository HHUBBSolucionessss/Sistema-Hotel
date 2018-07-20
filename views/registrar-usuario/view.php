<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\editable\Editable;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\RegistrarUsuario */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registrar-usuario-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="col-md-6">
        <?php
            echo DetailView::widget([
                'model'=>$model,
                'condensed'=>true,
                'hover'=>true,
                'mode'=>DetailView::MODE_VIEW,
                'panel'=>[
                    'heading'=>'Registrar Usuario </br>' . $model->nombre,
                    'type'=>DetailView::TYPE_INFO,
                ],
                'attributes'=>
                [
                    'nombre',
                    'email:email',
                    'username',
                    [
                        'attribute'=>'status',
                        'label'=>'Estado',
                        'format'=>'raw',
                        'value'=>$model->status ? '<span class="label label-success">Activa </span>' : '<span class="label label-danger">Inactiva</span>',
                        'type'=>DetailView::INPUT_SWITCH,
                        'widgetOptions' =>
                        [
                            'pluginOptions' =>
                            [
                                'onText' => 'Activa',
                                'offText' => 'Inactiva',
                            ]
                        ],
                    ],
                ]
            ]);

        ?>
        </div>


</div>
