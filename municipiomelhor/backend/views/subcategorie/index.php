<?php

use common\models\Subcategorie;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\SubcategorieSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div class="subcategorie-index">

    <h1>Subcategorias</h1>

    <p>
        <?= Html::a('Criar Subcategoria', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'categorie_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Subcategorie $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
