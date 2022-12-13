<?php
use yii\helpers\Html;
?>


    <div class="card-body login-card-body">

        <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'login-form']) ?>

        <!-- Section: Design Block -->
        <div class="card-body login-card-body">


            <div class="card mb-3">
                <div class="row g-0 d-flex align-items-center">
                    <div class="col-lg-4 d-none d-lg-flex">
                        <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" alt="Trendy Pants and Shoes"
                             class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
                    </div>
                    <div class="col-lg-8">
                        <h2 style="margin-left: 15rem;">BackOffice Municipio Melhor </h2>

                        <div class="card-body py-5 px-md-5">

                            <form>

                                <?= $form->field($model,'email', [
                                    'options' => ['class' => 'form-group has-feedback'],
                                    'inputTemplate' => '{input}',
                                    'template' => '{beginWrapper}{input}{error}{endWrapper}',
                                    'wrapperOptions' => ['class' => 'input-group mb-3']
                                ])
                                    ->label(false)
                                    ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

                                <?= $form->field($model, 'password', [
                                    'options' => ['class' => 'form-group has-feedback'],
                                    'inputTemplate' => '{input}',
                                    'template' => '{beginWrapper}{input}{error}{endWrapper}',
                                    'wrapperOptions' => ['class' => 'input-group mb-3']
                                ])
                                    ->label(false)
                                    ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

                                    <div class="login" style="margin-left: 41rem;">
                                        <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary btn-block']) ?>
                                    </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php \yii\bootstrap4\ActiveForm::end(); ?>
    </div>
    <!-- /.login-card-body -->