<?php

namespace app\modules\api\controllers;

use yii\rest\ActiveController;

class UserController extends ActiveController {

    public $modelClass = 'common\models\User';

    public function behaviors() {
        return null;
    }

    // GET VALIDATION USER LOGIN
    public function actionLogIn() {

    }

    // CREATE A NEW USER
    public function actionSingIn() {

    }
}