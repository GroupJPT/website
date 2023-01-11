<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Occurrence;
use common\models\OccurrenceSearch;
use common\models\Subcategory;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class OccurrenceController extends Controller {

    public function behaviors() {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'search', 'view'],
                            'roles' => [],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create', 'myoccurrences', 'subcategories'],
                            'roles' => ['@'],
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

    /** ==============================
     * Action to index page.
    ============================== **/

    public function actionIndex() { return $this->render('index'); }

    /** ==============================
     * Action to create occurrence.
    ============================== **/
    public function actionCreate() {
        $model = new Occurrence();

        if ($this->request->isPost) {
            $model->user_id = Yii::$app->user->getId();
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /** ==============================
     * Action to List occurrences of
     * authenticated user.
    ============================== **/
    public function actionMyoccurrences() {
        $searchModel = new OccurrenceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('myoccurrences', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /** ==============================
     * Action to search occurrences.
    ============================== **/
    public function actionSearch() {
        return $this->render('search');
    }

    /** ==============================
     * Action to list detales of
     * occurrence with id X.
    ============================== **/
    public function actionView($id) {

        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
            'category' => $this->getCategory($model->category_id),
            'subcategory' => $this->getSubcategory($model->subcategory_id)
        ]);
    }







    /** ==============================
     * FUNCTIONS
    ============================== **/
    protected function findModel($id) {
        if (($model = Occurrence::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getCategory($id) {
        return Category::findOne(['id' => $id]);
    }

    protected function getSubcategory($id) {
        return Subcategory::findOne(['id' => $id]);
    }

    public function actionSubcategories($id) {
        $countSubcategories = Subcategory::find()
            ->where(['category_id' => $id])
            ->count();

        $subcategories = Subcategory::find()
            ->where(['category_id' => $id])
            ->all();

        if($countSubcategories > 0){
            echo "<option value=''>Selecione uma subcategoria.</option>";
            foreach ($subcategories as $subcategory){
                echo "<option value='".$subcategory->id."'>".$subcategory->name."</option>";
            }
        }
        else
            echo "<option>Não existe subcategorias.</option>";
    }
}
