<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="col-sm-8">
        <h1>Histórico de Sugestões</h1>
        <table class="col-xs-7 table-bordered table-striped table-condensed table-fixed">
            <thead>
            <tr>
                <th class="col">ID</th>
                <th class="col">Morada</th>
                <th class="col">Descrição</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($suggestions as $suggestion):?>
                <tr>
                    <td class="col"><?php echo $suggestion['id']?></td>
                    <td class="col"><?php echo $suggestion['address']?></td>
                    <td class="col"><?php echo $suggestion['description']?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>

    </div>

</div>
