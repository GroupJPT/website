<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Menu ocorrências';

?>

<div class="row occ-menu text-center">
    <a class="col-4 h-100" href="<?= Url::to(['/occurrence/create']) ?>">
        <p>Criar Ocorrência</p>
        <?= Html::img('@web/images/pensil-icon.svg', ['class'=>'occ-menu-icons', 'alt'=>'Clipboard Icon'])?>
    </a>
    <a class="col-4 h-100" href="<?= Url::to(['/occurrence/myoccurrences']) ?>">
        <p>Minhas Ocorrências</p>
        <?= Html::img('@web/images/clipboard-icon.svg', ['class'=>'occ-menu-icons', 'alt'=>'Clipboard Icon'])?>
    </a>
    <a class="col-4 h-100" href="<?= Url::to(['/occurrence/search']) ?>">
        <p>Procurar Ocorrência</p>
        <?= Html::img('@web/images/search-icon.svg', ['class'=>'occ-menu-icons', 'alt'=>'Search Icon'])?>
    </a>
</div>

