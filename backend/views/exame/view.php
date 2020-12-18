<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\markdown\Markdown;

/* @var $this yii\web\View */
/* @var $model backend\models\Exame */

$this->title = 'Exame realizado no dia '.$model->date;
\yii\web\YiiAsset::register($this);
?>
<div class="exame-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr style="height:2px;border-width:0;color:black;background-color:black">
    <br>

    <h3>Data do Exame: </h3> <?= $model->date ?>
    <h3>Avaliação do Medico:</h3> <?= Markdown::convert($model->conteudo) ?>
    <h3>Medico Responsável: </h3><?= $model->medico->nome ?>

    <br>
    <br>
    <br>
</div>

<?= Html::a('Ver Exames', ['index'], ['class' => 'btn btn-success']) ?>
