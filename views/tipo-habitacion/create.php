<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoHabitacion */

$this->params['breadcrumbs'][] = ['label' => 'Tipo de Habitaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-habitacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
