<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Privilegio */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Privilegios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="privilegio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_usuario',
            'crear_habitacion',
            'modificar_habitacion',
            'eliminar_habitacion',
            'crear_tipo_habitacion',
            'modificar_tipo_habitacion',
            'eliminar_tipo_habitacion',
            'crear_caja',
            'modificar_caja',
            'eliminar_caja',
            'crear_huesped',
            'modificar_huesped',
            'eliminar_huesped',
            'crear_reservacion',
            'modificar_reservacion',
            'eliminar_reservacion',
            'descuento',
            'crear_tarifa',
            'modificar_tarifa',
            'eliminar_tarifa',
            'crear_origen',
            'modificar_origen',
            'eliminar_origen',
            'crear_usuario',
            'modificar_usuario',
            'eliminar_usuario',
        ],
    ]) ?>

</div>
