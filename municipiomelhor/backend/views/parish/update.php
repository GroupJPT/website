<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Parish $model */

$this->title = 'Update Parish: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Parishes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="parish-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
