<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Entrar || MunicípioMelhor!';
?>

<div class="container box_center_login">
    <div class="site-login">
        <h1 class="center_h1"><?= Html::encode($this->title) ?></h1>

        <p class="center">Insira as suas credenciais:</p>

        <div class="row">

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="my-1 mx-0" style="color:#999;">
                Não tem conta? Faça registo <?= Html::a('aqui', ['site/signup']) ?>!
            </div>

            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
