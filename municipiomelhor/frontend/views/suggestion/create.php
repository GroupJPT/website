<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Suggestion $model */

$this->title = 'Criar Sugestão';
$this->params['breadcrumbs'][] = ['label' => 'Sugestões', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suggestion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
