<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Occurrence $model */

$this->title = 'Update Occurrence: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Occurrences', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="occurrence-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
