<?php

use common\models\Suggestion;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

$this->title = 'Sugestões';
?>
<div style="text-align:center; margin-top: 5rem;" class="suggestion-index">

    <h1 style="font-size: 50px;"><?= Html::encode($this->title) ?></h1>

    <p>A caixa de sugestões foi criada com o objetivo de todos os residentes do municipio poderem enviar sugestões de alguma melhoria que poderia ser feita ou até construir algo inovador para o Municipio e pudesse até atrair mais gente para o mesmo.</p>

    <p>
        <?= Html::a('Criar Sugestão', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


</div>
