<?php

use hail812\adminlte\widgets\Menu;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Yii::$app->homeUrl ?>" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
                    ['label' => 'GESTÃO', 'header' => true],
                    ['label' => 'Utilizadores', 'url' => ['/user']],
                    ['label' => 'Occorrências', 'url' => ['/ocorrencias']],
                    ['label' => 'Eventos', 'url' => ['/eventos']],
                    ['label' => 'Solicitações', 'url' => ['/solicitacoes']],
                    ['label' => 'Notícias', 'url' => ['/noticias']],
                    ['label' => 'Avisos', 'url' => ['/avisos']],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>