<?php
use common\models\Occurrence;
use yii\bootstrap5\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Minhas Ocorrências || MunicípioMelhor!';
?>

<div class="occurrence-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'description:ntext',
            'address',
            'region',
            'postal_code',
            //'lat',
            //'lng',
            //'user_id',
            //'category_id',
            //'subcategory_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Occurrence $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>