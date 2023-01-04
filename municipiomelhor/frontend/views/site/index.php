<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Município Melhor!';
?>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<div class="home-header">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1>Porquê esperar? Melhora já o teu Município!</h1>
                <p>A aplicação MunicipioMelhor foi desenvolvida para ajudar e poupar tempo aos cidadãos do Município. Através da mesma será possivel registar ocorrências observadas na via pública, como defeitos na iluminação de uma rua, entre muitos outros problemas com que nos deparamos no dia a dia.</p>
                <a class="col-4 h-100" style="color:black;" href="<?= Url::to(['/occurrence/create']) ?>">Criar ocorrência</a>
            </div>
            <div class="col-6">
                <?= Html::img('@web/images/home-header.svg', ['class'=>'']) ?>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row abb">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ocorência Nº1</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Data de publicação:</small></p>
                    <a href="#" class="fa fa-eye" style="color:black;text-decoration: none;" id="detalheOcorrencia"></a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Facilidade</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Data de publicação:</small></p>
                    <a href="#" class="fa fa-eye" style="color:black;text-decoration: none;" id="detalheOcorrencia"></a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Eficaz</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Data de publicação:</small></p>
                    <a href="#" class="fa fa-eye" style="color:black;text-decoration: none;" id="detalheOcorrencia"></a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Eficiencia</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Data de publicação:</small></p>
                    <a href="#" class="fa fa-eye" style="color:black;text-decoration: none;" id="detalheOcorrencia"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="height: 3000px"></div>
</div>