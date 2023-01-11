<?php

use common\models\Category;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Pesquisar Ocorrências || MunicípioMelhor!';
?>

<div class="container">
    <div class="row-cols-1">
        <?php foreach ($occurrences as $occurrence) {
            ?>

            <div onclick="" style="height: 200px; background-color: red;" class="col h-100">
                <p> <?= $occurrence->id ?> </p>
                <p> <?= $occurrence->description ?> </p>
                <p> <?= $occurrence->address ?>, <?= $occurrence->postal_code ?> <?= $occurrence->region ?></p>
            </div>

        <?php } ?>
    </div>
</div>
