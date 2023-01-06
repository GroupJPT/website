<?php

namespace app\modules\v1\controllers;

use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class UserController extends ActiveController {

    public $modelClass = 'common\models\User';

    public function behaviors() {

        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = ['class' => QueryParamAuth::className()];
        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if ($action === 'post' or $action === 'delete') {
            if(Yii::$app->user->isGuest) {
                throw new ForbiddenHttpException('Apenas poderá'.$action.' utilizadores registados...');
            }
        }
    }

    public function actionUtilizadores() {
        return ['Hello', 'World'];
    }
}