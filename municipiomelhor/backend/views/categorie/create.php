<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Categorie $model */

$this->title = 'Create Categorie';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorie-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>