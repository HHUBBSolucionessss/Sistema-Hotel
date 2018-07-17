<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoHabitacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo Habitacions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-habitacion-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Create Tipo Habitacion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
            $gridColumns = [
                ['class' => 'kartik\grid\SerialColumn'],
                [
                    'attribute' => 'id',
                    'vAlign'=>'middle',
                    'headerOptions'=>['class'=>'kv-sticky-column'],
                    'contentOptions'=>['class'=>'kv-sticky-column'],
                ],
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
