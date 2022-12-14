<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Subcategorie $model */

$this->title = 'Create Subcategorie';
$this->params['breadcrumbs'][] = ['label' => 'Subcategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcategorie-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
