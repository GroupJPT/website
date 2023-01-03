<?php
use common\models\Occurrence;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Minhas Ocorrências';
$userid=Yii::$app->user->getId();
$ocurrences=Occurrence::find()->where("user_id"==$userid)->all();

print_r($ocurrences);


?>
