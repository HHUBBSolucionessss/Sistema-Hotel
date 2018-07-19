<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Habitacion */

$this->title = 'Crear Habitaciones';
$this->params['breadcrumbs'][] = ['label' => 'Habitaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="habitacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
