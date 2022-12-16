<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Suggestion $model */

$this->title = 'Atualizar Sugestão: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sugestões', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="suggestion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
