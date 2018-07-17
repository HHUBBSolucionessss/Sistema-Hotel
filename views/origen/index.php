<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrigenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Origens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="origen-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Origen', ['create'], ['class' => 'btn btn-success']) ?>
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
                    'attribute' => 'nombre',
                    'vAlign'=>'middle',
                    'headerOptions'=>['class'=>'kv-sticky-column'],
                    'contentOptions'=>['class'=>'kv-sticky-column'],
                ],
                [
                    'attribute' => 'create_time',
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
        </div>
