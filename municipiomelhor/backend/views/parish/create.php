<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Parish $model */

$this->title = 'Create Parish';
$this->params['breadcrumbs'][] = ['label' => 'Parishes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parish-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
