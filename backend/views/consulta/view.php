<?php

use kartik\markdown\Markdown;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Consulta */

$this->title = 'Consulta realizada no dia: '.$model->date;
\yii\web\YiiAsset::register($this);
?>
<div class="consulta-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr style="height:2px;border-width:0;color:black;background-color:black">
    <br>

    <h3>Data da Consulta: </h3> <?= $model->date ?>
    <h3>Avaliação do Medico:</h3> <?= Markdown::convert($model->conteudo) ?>
    <h3>Medico Responsável: </h3><?= $model->medico->nome ?>

    <br>
    <br>
    <br>
</div>

<?= Html::a('Ver Consulta', ['index'], ['class' => 'btn btn-success']) ?>
