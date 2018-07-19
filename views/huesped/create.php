<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Huesped */

$this->title = 'Crear Huésped';
$this->params['breadcrumbs'][] = ['label' => 'Huéspedes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="huesped-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
