<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Registar || MunnicípioMelhor!';
?>

<div class="container box_text_center">
    <div class="site-signup">

        <h1 class="center_h1">Registar Novo Utilizador</h1>

        <p class="center">Preencha todos os campos para realizar o registo:</p>

        <div class="row">
            <div>
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field ($model, 'name')->textInput() ?>

                <?= $form->field($model, 'surname')->textInput() ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Registar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>

                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>
