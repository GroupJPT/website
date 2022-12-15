<?php

namespace frontend\controllers;

use common\models\User;
use Yii;
use yii\base\InvalidArgumentException;
use yii\captcha\CaptchaAction;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use yii\web\ErrorAction;

class SiteController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
            'captcha' => [
                'class' => CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }

    /** ==============================
    // LOG-IN IN FRONTEND
    ============================== **/
    public function actionLogin() {
        if (!Yii::$app->user->isGuest)
            return $this->goHome();

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
            return $this->goBack();

        $model->password = '';

        return $this->render('login', ['model' => $model,]);
    }

    /** ==============================
    // LOG-OUT FROM FRONTEND
    ============================== **/
    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionAbout() {
        return $this->render('about');
    }


    /** ==============================
    // SIGN-UP AND LOG-IN AUTOMATICALLY
    ============================== **/
    public function actionSignup() {
        if (!Yii::$app->user->isGuest)
            return $this->goHome();

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {

            if ($model ->signup()) {
                $identity = User::findOne(['email' => $model->email]);
                if (Yii::$app->user->login($identity))
                    return $this->goHome();
            }

            return $this->goBack();
        }

        return $this->render('signup', ['model' => $model]);
    }

    /*
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', ['model' => $model]);
    }

    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', ['model' => $model]);
    }
    */
}
