<?php

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
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
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    /** ==============================
    // NAVBAR CONFIG
    ============================== **/
    NavBar::begin([
        'brandLabel' => Html::img('@web/images/icon.png', ['class'=>'navbar-img', 'alt'=>Yii::$app->name]),
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
            ['label' => 'Home', 'url' => ['#']],
            ['label' => 'Ocorrencias', 'url' => ['/occurrence']],
            ['label' => 'Avisos', 'url' => ['#']],
            ['label' => 'Solicitações', 'url' => ['#']],
        ]
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right d-flex align-items-left justify-content-end nav w-100'],
        'items' => $menuItemsAuth,
    ]);

    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; MunicipioMelhor <?= date('Y') ?></p>
        <p class="float-end"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
