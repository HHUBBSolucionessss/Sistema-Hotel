<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Privilegio */

$this->title = Yii::t('app', 'Update Privilegio: ' . $model->id_usuario, [
    'nameAttribute' => '' . $model->id_usuario,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Privilegios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_usuario, 'url' => ['update', 'id_usuario' => $model->id_usuario]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="privilegio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
