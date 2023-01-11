<?php
use common\models\Occurrence;
use yii\bootstrap5\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Minhas Ocorrências || MunicípioMelhor!';
?>

<div class="occurrence-index">

    <?php

    foreach ($occurrences as $occurrence){
        echo $occurrence->id;
    }

    ?>

</div>