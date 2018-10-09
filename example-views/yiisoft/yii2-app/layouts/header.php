<?php
use yii\helpers\Html;
?>

<header class="main-header">
    <?= Html::a('<span class="logo-mini">Hotel</span><span class="logo-lg"> Sistema Hotel</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
    </nav>
</header>
