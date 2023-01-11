<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;

class SiteController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index', 'error'],
                        'allow' => true,
                        'roles' => ['Admin', 'Appraiser', 'Employee'],
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
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /** ==============================
    // LOG-IN IN FRONTEND
    ============================== **/
    public function actionIndex() {
        return $this->render('index');
    }

    /** ==============================
    // ACTION TO LOG-IN IN BACKEND.
    ============================== **/
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->user->can('backendAccess'))
                return $this->goBack();
            Yii::$app->user->logout();
        } else {
            Yii::$app->user->logout();
        }

        $model->password = '';

        return $this->render('login', ['model' => $model]);
    }

    /** ==============================
    // ACTION TO LOG-OUT FROM BACKEND.
    ============================== **/
    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
