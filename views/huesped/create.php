<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Huesped */


$this->params['breadcrumbs'][] = ['label' => 'Huéspedes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="huesped-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
