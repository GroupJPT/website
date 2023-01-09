<?php

namespace frontend\controllers;

use common\models\Suggestion;
use common\models\SuggestionSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class SuggestionController extends Controller {

    public function behaviors() {
        return array_merge(
            parent::behaviors(),
            [
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
        return $this->render('index');
    }

    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate() {
        $model = new Suggestion();

        if ($this->request->isPost) {
            $model->user_id = Yii::$app->user->getId();
            if ($model->load($this->request->post()) && $model->save())
                return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save())
            return $this->redirect(['view', 'id' => $model->id]);

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if (($model = Suggestion::findOne(['id' => $id])) !== null)
            return $model;

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
