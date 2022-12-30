<?php

/** @var yii\web\View $this */
use yii\bootstrap5\Html;


$this->title = 'Município Melhor';
?>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="main-slider slick-initialized slick-slider" aria-hidden="true">
            <div aria-live="polite" class="slick-list draggable"><div class="slick-track" role="listbox" style="opacity: 1; width: 1100px; transform: translate3d(0px, 0px, 0px);"><div class="main-slider__item slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide00" style="width: 1100px;">

                        <a>
                            <img src="/images/divulgarapp.png" class="imagem-fundo-pag-inicial"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="body-content">

        <div id="map"></div>

        <input type="text" class="form-control" placeholder="lat" name="lat" id="lat">
        <input type="text" class="form-control" placeholder="lng" name="lng" id="lng">

        <div class="container-fluid">
            <div class="card-group">

                <div class="card">
                    <img src="/images/divulgarapp.png"/>

                    <div class="card-body">
                        <h5 class="card-title">Ocorência Nº1</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-muted">Data de publicação:</small></p>
                        <a href="#" class="fa fa-eye" style="color:black;text-decoration: none;" id="detalheOcorrencia"></a>
                    </div>
                </div>

                <div class="card">
                    <img src="/images/divulgarapp.png"/>

                    <div class="card-body">
                        <h5 class="card-title">Ocorência Nº2</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-muted">Data de publicação:</small></p>
                        <a href="#" class="fa fa-eye" style="color:black;text-decoration: none;" id="detalheOcorrencia"></a>
                    </div>
                </div>
                <div class="card">
                    <img src="/images/divulgarapp.png"/>

                    <div class="card-body">
                        <h5 class="card-title">Ocorência Nº3</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-muted">Data de publicação:</small></p>
                        <a href="#" class="fa fa-eye" style="color:black;text-decoration: none;" id="detalheOcorrencia"></a>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
