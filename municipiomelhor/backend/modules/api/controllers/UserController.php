<?php

namespace app\modules\api\controllers;

use common\models\User;
use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class UserController extends ActiveController {

    public $modelClass = 'common\models\User';

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = ['class' => QueryParamAuth::className(), 'except' => ['login']];
        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = []) {
        if ($action === 'view' or $action === 'create' or $action === 'index') {
            throw new ForbiddenHttpException('Apenas poderá'.$action.' utilizadores registados...');
        }
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    // GET VALIDATION USER LOGIN
    public function actionLogin($email) {
        $user = User::findByEmail($email);

    }


    // GET USER INFOS
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    // UPDATE USER INFOS
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update');
    }
}