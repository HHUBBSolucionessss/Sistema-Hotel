<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Prueba */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pruebas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prueba-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_habitacion',
            'id_origen',
            'id_huesped',
            'fecha_entrada',
            'fecha_salida',
            'notas',
            'adultos',
            'ninos',
            'noches',
            'status',
            'estado_pago',
            'tipo',
            'saldo',
            'subtotal',
            'descuento',
            'total',
            'create_time',
            'create_user',
            'update_time',
            'update_user',
        ],
    ]) ?>

</div>
