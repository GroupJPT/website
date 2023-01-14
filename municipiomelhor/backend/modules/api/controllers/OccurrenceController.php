<?php

namespace app\modules\api\controllers;

use common\models\Occurrence;
use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class OccurrenceController extends ActiveController {

    public $modelClass = 'common\models\Occurence';

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

    // GET ALL OCCURRENCE FROM AUTH USER
    public function actionGetAllMyOccurrence() {

    }

    // GET ALL OCCURRENCE FOLLOW FROM AUTH USER
    public function actionGetAllOccurrenceFollow() {

    }
}