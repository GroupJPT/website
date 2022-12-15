<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Occurrence $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="occurrence-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'categorie_id')->textInput() ?>

    <?= $form->field($model, 'subcategorie_id')->textInput() ?>

    <?= $form->field($model, 'parish_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
