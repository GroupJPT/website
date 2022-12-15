<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Occurrence $model */

$this->title = 'Create occurrence';
$this->params['breadcrumbs'][] = ['label' => 'Occurrences', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="occurrence-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
