<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Occurrence $model */

$this->title = 'Criar Ocurrência';
$this->params['breadcrumbs'][] = ['label' => 'Ocorrência', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="occurrence-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
