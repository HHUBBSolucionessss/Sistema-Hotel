<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PruebaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prueba para el Excel';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prueba-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Prueba', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'id_habitacion',
                'value'=>function ($model) {
                    return $model->getReservaciones();
                },
                'format'=>'raw'
            ],
            'id_origen',
            'id_huesped',
            'fecha_entrada',
            //'fecha_salida',
            //'notas',
            //'adultos',
            //'ninos',
            //'noches',
            //'status',
            //'estado_pago',
            //'tipo',
            //'saldo',
            //'subtotal',
            //'descuento',
            //'total',
            //'create_time',
            //'create_user',
            //'update_time',
            //'update_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
