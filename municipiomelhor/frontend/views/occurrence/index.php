<?php

use common\models\Occurrence;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\OccurrenceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ocorrências';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="occurrence-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Ocorrência', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'description:ntext',
            'user_id',
            'categorie_id',
            'subcategorie_id',
            //'parish_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Occurrence $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
