<?php
use common\models\Occurrence;
use common\models\OccurrenceFollow;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Minhas Ocorrências';


?>

<div class="container">
    <div class="occ-menu text-center row">
        <div class="col-12 h-50">
            <h2>Minhas Ocorrências</h2>
            <table id="example" class="uk-table uk-table-hover uk-table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Morada</th>
                    <th>Região</th>
                    <th>Código Postal</th>
                    <th>Utilizador</th>
                    <th>Categoria</th>
                    <th>Subcategoria</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($myoccurrences as $occurrence)
                {?>

                        <tr>
                            <td><?php echo $occurrence->id?></td>
                            <td><?php echo substr($occurrence->description,0,50)?></td>
                            <td><?php echo $occurrence->address ?></td>
                            <td><?php echo $occurrence->region?></td>
                            <td><?php echo $occurrence->postal_code?></td>
                            <td><?php echo $occurrence->user_id ?></td>
                            <td><?php echo $occurrence->category_id ?></td>
                            <td><?php echo $occurrence->subcategory_id ?></td>
                            <td>
                                <ul>
                                    <li><a href="?r=ocurrence%2Fview&id=<?php echo $occurrence->id?>" class="btn btn-success"><i class="fa fa-search"></i></a></li>
                                </ul>
                            </td>
                       </tr>
                <?php
                }
                ?>
                </tbody>
            </table>

        </div>
        <div class="col-12 h-50">

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
                foreach($occurrences as $result)
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
</div>
