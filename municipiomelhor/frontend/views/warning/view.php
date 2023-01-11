<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Avisos: '.$model->name.' || MunicípioMelhor!';

?>
<div class="warning-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
            'created_at',
        ],
    ]) ?>

</div>
