<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RegistrarUsuario */


$this->params['breadcrumbs'][] = ['label' => 'Registrar Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registrar-usuario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
