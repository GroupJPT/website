<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Suggestion $model */

$this->title = 'Criar Sugestão';
?>
<div class="suggestion-create">

    <h1 class="suggestionTitle"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
