<?php

use yii\helpers\Html;
use yii\grid\GridView;
use moonland\phpexcel\Excel;
use app\models\Privilegio;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PrivilegioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Privilegios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="privilegio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Privilegio'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    Excel::export([
      	'models' => $dataProvider,
      	'columns' => ['column1','column2','column3'], //without header working, because the header will be get label from attribute label.
      	'header' => ['column1' => 'Header Column 1','column2' => 'Header Column 2', 'column3' => 'Header Column 3'],
      ]);

      ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_usuario',
            'crear_habitacion',
            'modificar_habitacion',
            'eliminar_habitacion',
            //'crear_tipo_habitacion',
            //'modificar_tipo_habitacion',
            //'eliminar_tipo_habitacion',
            //'modificar_caja',
            //'crear_huesped',
            //'modificar_huesped',
            //'eliminar_huesped',
            //'crear_reservacion',
            //'modificar_reservacion',
            //'eliminar_reservacion',
            //'descuento',
            //'crear_tarifa',
            //'modificar_tarifa',
            //'eliminar_tarifa',
            //'crear_origen',
            //'modificar_origen',
            //'eliminar_origen',
            //'crear_usuario',
            //'modificar_usuario',
            //'eliminar_usuario',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
