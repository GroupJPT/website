<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Subcategory $model */

$this->title = 'Create Subcategory';
$this->params['breadcrumbs'][] = ['label' => 'Subcategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcategorie-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
