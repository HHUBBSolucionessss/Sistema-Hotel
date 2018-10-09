<?php
use yii\helpers\Html;
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/usuario.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->nombre ?></p>
                <?= Html::a(
                    'Salir del sistema',
                    ['/site/logout'],
                    ['data-method' => 'post', 'class' => 'btn btn-danger btn-xs']
                ) ?>
            </div>
        </div>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu de opciones', 'options' => ['class' => 'header']],
                    ['label' => 'Habitaciones', 'icon' => 'file-code-o', 'url' => ['/habitacion/index']],
                    ['label' => 'Caja', 'icon' => 'dashboard', 'url' => ['/caja/index']],
                    ['label' => 'Huespedes', 'icon' => 'dashboard', 'url' => ['/huesped/index']],
                    ['label' => 'Reservaciones', 'icon' => 'dashboard', 'url' => ['/reservacion/index']],
                    ['label' => 'Tarifas', 'icon' => 'dashboard', 'url' => ['/tarifa/index']],
                    ['label' => 'Origenes', 'icon' => 'dashboard', 'url' => ['/origen/index']],
                    ['label' => 'Registro Sistema', 'icon' => 'dashboard', 'url' => ['site/registro']],
                    ['label' => 'Usuario', 'icon' => 'dashboard', 'url' => ['/registrar-usuario']],
                ],
            ]
        ) ?>
    </section>
</aside>
