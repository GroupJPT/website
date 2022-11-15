<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\ArrayHelper;

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
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    // Configurações da NavBar
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md fixed-top',
        ],
    ]);

    // Items da NavBar
    $menuItemsOption = [
        ['label' => 'Home', 'url' => ['#']],
        ['label' => 'Ocorrencias', 'url' => ['#']],
    ];

    if (Yii::$app->user->isGuest)
        $menuItemsAuth = [['label' => 'Entrar', 'url' => ['/site/login']]];
    else
        $menuItemsAuth = [['label' => 'Olá '.Yii::$app->user->identity->username, 'items' => [
            ['label' => 'Perfil', 'url' => ['#']],
            ['label' => 'Minhas Occorencias', 'url' => ['#']],
            ['label' => 'Sair', 'linkOptions' => ['data-method' => 'post'], 'url' => ['/site/logout']],
        ]]];

    $menuItems = ArrayHelper::merge($menuItemsOption, $menuItemsAuth);

    // Criar Items na NavBar
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $menuItems,
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
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
