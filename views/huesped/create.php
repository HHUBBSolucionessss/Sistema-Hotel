<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Huesped */

$this->title = 'Create Huesped';
$this->params['breadcrumbs'][] = ['label' => 'Huespeds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="huesped-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
