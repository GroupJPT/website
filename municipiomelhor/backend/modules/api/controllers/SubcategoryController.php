<?php

namespace app\modules\api\controllers;

use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class SubategoryController extends ActiveController {

    public $modelClass = 'common\models\subategory';

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = ['class' => QueryParamAuth::className()];
        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = []) {
        if ($action === 'post' or $action === 'delete') {
            if(Yii::$app->user->isGuest) {
                throw new ForbiddenHttpException('Apenas poderá'.$action.' utilizadores registados...');
            }
        }
    }

    // GET ALL SUBCATEGORY FROM CATEGORY ID
    public function actionGetAllSubcategoriesFromCategoryId($id) {

    }
}