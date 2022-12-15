<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Warning $model */

$this->title = 'Criar Aviso';
$this->params['breadcrumbs'][] = ['label' => 'Warnings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warning-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
