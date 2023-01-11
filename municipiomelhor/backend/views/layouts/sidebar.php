<?php

use hail812\adminlte\widgets\Menu;
use yii\helpers\Html;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Yii::$app->homeUrl ?>" class="brand-link">
        <?= Html::img('@web/imgs/icon-navbar.svg', ['class'=>'brand-image', 'alt'=>Yii::$app->name]) ?>
        <span class="brand-text font-weight-light">MunicípioMelhor!</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= Yii::$app->user->identity->name ?> <?= Yii::$app->user->identity->surname ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo Menu::widget([
                'items' => [
                    ['label' => 'Gestão', 'header' => true],
                    ['label' => 'Utilizadores', 'url' => ['/user'], 'visible' => Yii::$app->user->can('userCRUD')],
                    ['label' => 'Occorrências', 'url' => ['/occurrence'], 'visible' => Yii::$app->user->can('occurrenceCRUD')],
                    ['label' => 'Sugestões', 'url' => ['/suggestion'], 'visible' => Yii::$app->user->can('suggestionCRUD')],
                    ['label' => 'Avisos', 'url' => ['/warning'], 'visible' => Yii::$app->user->can('warningCRUD')],
                    ['label' => 'Categorias', 'url' => ['/category'], 'visible' => Yii::$app->user->can('categoryCRUD')],
                    ['label' => 'Ferramentas de Programador', 'header' => true, 'visible' => Yii::$app->user->can('devTools')],
                    ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank', 'visible' => Yii::$app->user->can('devTools')],
                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank', 'visible' => Yii::$app->user->can('devTools')],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>