<?php

use common\models\Suggestion;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\SuggestionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div class="suggestion-index">

    <h1>Sugestões</h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'address',
            'description:ntext',
            'user_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Suggestion $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
