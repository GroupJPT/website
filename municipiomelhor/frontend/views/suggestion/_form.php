<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Suggestion $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="container">
    <div class="suggestion-form">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <div class="form-group" style="width: 12%;margin-left: 90%;margin-top: 3%;">
            <?= Html::submitButton('Enviar Sugestão', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
