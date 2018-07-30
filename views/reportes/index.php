<?php

use yii\helpers\Html;

use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HabitacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reportes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reportes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::button('Habitaciones por día', ['value'=>Url::to('../habitacion/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
    </p>
    <p>
        <?= Html::button('Llegadas y entradas', ['value'=>Url::to('../habitacion/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
    </p>
    <p>
        <?= Html::button('Habitaciones ocupadas', ['value'=>Url::to('../habitacion/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
    </p>
    <p>
        <?= Html::button('Habitaciones con adeudo', ['value'=>Url::to('../habitacion/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
    </p>
    <p>
        <?= Html::button('Habitaciones no show', ['value'=>Url::to('../habitacion/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
    </p>
    <p>
        <?= Html::button('Habitaciones canceladas', ['value'=>Url::to('../habitacion/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
    </p>
    <p>
        <?= Html::button('Ingresos / cortes de caja', ['value'=>Url::to('../habitacion/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
    </p>
    <p>
        <?= Html::button('Registro sistema', ['value'=>Url::to('../habitacion/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
    </p>

</div>
