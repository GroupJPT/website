<?php

/** @var yii\web\View $this */
use yii\bootstrap5\Html;


$this->title = 'Município Melhor';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="main-slider slick-initialized slick-slider" aria-hidden="true">
            <div aria-live="polite" class="slick-list draggable"><div class="slick-track" role="listbox" style="opacity: 1; width: 1100px; transform: translate3d(0px, 0px, 0px);"><div class="main-slider__item slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide00" style="width: 1100px;">

                        <a class="main-slider__item__background" tabindex="0">
                            <?php
                            Html::img('@web/images/testeapp.jpg');
                            ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="body-content">

        <div class="container-fluid">
            <div class="card-group">
                <div class="card">
                    <?php Html::img('@web/images/testeapp.jpg');?>
                    <div class="card-body">
                        <h5 class="card-title">Occorência Nº1</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        <button class="fa fa-eye" id="detalheOcorrencia"></button>
                    </div>
                </div>
                <div class="card" style="margin:5px 5px 5px 5px;">
                    <img src="..." class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Occorência Nº2</h5>
                        <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        <button class="fa fa-eye" id="detalheOcorrencia"></button>
                    </div>
                </div>
                <div class="card" style="margin:5px 5px 5px 5px;">
                    <img src="..." class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Occorência Nº3</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        <button class="fa fa-eye" id="detalheOcorrencia"></button>

                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
