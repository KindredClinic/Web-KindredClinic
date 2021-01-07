<?php

use kartik\markdown\Markdown;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ReceitaMedica */


$this->title = 'Receita passada no dia: '.$model->date;
\yii\web\YiiAsset::register($this);
?>
<div class="exame-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr style="height:2px;border-width:0;color:black;background-color:black">
    <br>

    <h3>Data da Receita </h3> <?= $model->date ?>
    <h3>Conteúdo</h3> <?= Markdown::convert($model->conteudo) ?>
    <h3>Medicamento</h3><?= $model->medicamento->nome?>
    <h3>Medico </h3><?= $model->medico->nome?>
    <h3>Utente </h3><?= $model->utente->nome?>

    <br>
    <br>
    <br>
</div>

<?= Html::a('Ver Receitas', ['index'], ['class' => 'btn btn-success']) ?>
