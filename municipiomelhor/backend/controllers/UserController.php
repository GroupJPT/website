<?php

namespace backend\controllers;

use common\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/** ==============================
// BACKEND USER CONTROLLER
============================== **/

class UserController extends Controller {

    public function behaviors() {

        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['view', 'index', 'error', 'update'],
                            'allow' => true,
                            'roles' => ['Admin', 'Employee'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate() {
        $model = new User();

        /**
        //BackEnd
        public function createUser() {
        $user = new User();

        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->email = $this->email;
        $user->generateAuthKey();
        $user->setPassword($this->password_hash);
        $user->parish_id = $this->parish_id;
        $user->save(false);

        $auth = Yii::$app->authManager;
        $userRole = $auth->getRole('User');
        $auth->assign($userRole, $user->getId());

        return $user;
        }
         **/


        if ($this->request->isPost)
            if ($model->load($this->request->post()) && $model->save())
                return $this->redirect(['view', 'id' => $model->id]);
        else
            $model->loadDefaultValues();


        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save())
            return $this->redirect(['view', 'id' => $model->id]);

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id) {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if (($model = User::findOne(['id' => $id])) !== null)
            return $model;

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
