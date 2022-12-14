<?php

use common\models\Warning;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\WarningSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div class="warning-index">

    <h1>Avisos</h1>

    <p>
        <?= Html::a('Criar Aviso', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description:ntext',
            'created_at',
            'categorie_id',
            //'parish_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Warning $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
