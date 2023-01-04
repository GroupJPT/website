<?php
use common\models\Occurrence;
use common\models\OccurrenceFollow;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Minhas Ocorrências';
$userid=Yii::$app->user->getId();

$ocurrences=Occurrence::find()->where("user_id"==$userid)->all();

$ocurrencesfollow=OccurrenceFollow::find()->where("user_id"==$userid)->all();



?>


<div class="row occ-menu text-center">
    <div class="col-6 h-100">
        <h2>Minhas Ocorrências</h2>
        <table id="example" class="uk-table uk-table-hover uk-table-striped" style="width:100%">
            <thead>
            <tr>
                <th>Nome Criador</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Subcategoria</th>
                <th>Estado Ocorrência</th>
                <th>Localidade</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($ocurrences as $result)
            {
                echo '<tr>';
                echo '<td>' . $result['id'] . '</td>';
                echo '<td>' . $result['description'] . '</td>';
                echo '<td>' . $result['user_id'] . '</td>';
                echo '<td>' . $result['categorie_id'] . '</td>';
                echo '<td>' . $result['subcategorie_id'] . '</td>';
                echo '<td>' . $result['parish_id'] . '</td>';

                echo '</td>';
            }
            ?>
            </tbody>
        </table>

    </div>
    <div class="col-6 h-100">

        <h2>Ocorrências seguidas</h2>
        <table id="example" class="uk-table uk-table-hover uk-table-striped" style="width:100%">
            <thead>
            <tr>
                <th>Nome Criador</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Subcategoria</th>
                <th>Data Criação</th>
                <th>Estado Ocorrência</th>
                <th>Localidade</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($ocurrencesfollow as $result)
            {
                echo '<tr>';
                echo '<td>' . $result['id'] . '</td>';
                echo '<td>' . $result['created_at'] . '</td>';
                echo '<td>' . $result['user_id'] . '</td>';
                echo '<td>' . $result['occurrence_id'] . '</td>';
                echo '</td>';
            }
            ?>

            </tbody>
        </table>


    </div>
</div>
