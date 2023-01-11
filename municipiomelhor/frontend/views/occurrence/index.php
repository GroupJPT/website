<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Menu Ocorrências || MunicípioMelhor!';

?>

<div class="row occ-menu text-center">
    <a class="col-4 h-100" href="<?= Url::to(['/occurrence/create']) ?>">
        <p>Criar Ocorrência</p>
        <?= Html::img('@web/imgs/pensil-icon.svg', ['class'=>'occ-menu-icons', 'alt'=>'Pensil Icon'])?>
    </a>
    <a class="col-4 h-100" href="<?= Url::to(['/occurrence/myoccurrences']) ?>">
        <p>Minhas Ocorrências</p>
        <?= Html::img('@web/imgs/clipboard-icon.svg', ['class'=>'occ-menu-icons', 'alt'=>'Clipboard Icon'])?>
    </a>
    <a class="col-4 h-100" href="<?= Url::to(['/occurrence/search']) ?>">
        <p>Procurar Ocorrência</p>
        <?= Html::img('@web/imgs/search-icon.svg', ['class'=>'occ-menu-icons', 'alt'=>'Search Icon'])?>
    </a>
</div>