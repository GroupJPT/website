<?php

use frontend\assets\AppAsset;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    /** ==============================
    // NAVBAR CONFIG
    ============================== **/
    NavBar::begin([
        'brandLabel' => Html::img('@web/images/icon-navbar.svg', ['class'=>'icon', 'alt'=>Yii::$app->name]),
        'brandUrl' => Yii::$app->homeUrl,
        'brandOptions' => ['class' => 'myclass'],
        'options' => [
            'class' => 'navbar navbar-expand-md fixed-top',
        ],
    ]);

    // Test to see if user are authenticated
    if (Yii::$app->user->isGuest)
        $menuItemsAuth = [['label' => 'Entrar', 'url' => ['/site/login'], 'options' => ['class' => 'justify-content-end']]];
    else
        $menuItemsAuth = [['label' => 'Olá '.Yii::$app->user->identity->name." ".Yii::$app->user->identity->surname, 'items' => [
            ['label' => 'Perfil', 'url' => ['#']],
            ['label' => 'Minhas Occorencias', 'url' => ['#']],
            ['label' => 'Sair', 'linkOptions' => ['data-method' => 'post'], 'url' => ['/site/logout']],
        ]]];

    // Create NavBar Items
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right d-flex align-items-left justify-content-start nav w-100'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site']],
            ['label' => 'Ocorrencias','url' => ['/occurrence']],
            ['label' => 'Avisos', 'url' => ['/warning']],
            ['label' => 'Sugestões', 'url' => ['/suggestion']],
            ]]);


    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right d-flex align-items-left justify-content-end nav w-100'],
        'items' => $menuItemsAuth,
    ]);

    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <?= $content; ?>

    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>

    <script>
        addEventListener("load", (event) => {
            $(".loader-wrapper").fadeOut("slow");
        })

        function createOccurrence() {
            $(".loader-wrapper").fadeIn("slow");
        }
    </script>
</main>
<!--
<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <div class="row">
            <div class="col">
                <p>dsadas</p>

            </div>
            <div class="col">
                <p>dsadas</p>

            </div>
            <div class="col">
                <p>dsadas</p>

            </div>
            <div class="col">
                <p>dsadas</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="float-start"><?= date('Y') ?> &copy; MunicípioMelhor!, Todos os direitos reservados.</p>
            </div>
            <div class="col">
                <?php /*
                    echo Nav::widget([
                    'options' => ['class' => 'float-end'],
                    'items' => [
                        ['label' => 'Privacidade', 'url' => ['/site']],
                        ['label' => 'Avisos Legal','url' => ['/occurrence']],
                        ['label' => 'Termos', 'url' => ['/warning']],
                    ]]);*/
                ?>
            </div>
        </div>
    </div>
</footer>
-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
