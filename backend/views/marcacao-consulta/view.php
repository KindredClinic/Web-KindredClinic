<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MarcacaoConsulta */

$this->title = 'Estado da Consulta';
\yii\web\YiiAsset::register($this);
?>
<div class="marcacao-consulta-view">

    <br>

    <h1><?= Html::encode($this->title) ?></h1>
    <?=$model->changeColor($model->status)?>

    <br>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'attribute' => 'date',

            [
                'attribute'=>'id_medico',
                'value'=>$model->medico->nome
            ],
            [
                'attribute'=>'id_especialidade',
                'value'=>$model->especialidade->tipo
            ],
            [
                'attribute'=>'id_utente',
                'value'=>$model->utente->nome
            ],
        ],
    ]) ?>

    <?php
    if($model->status == 'Aprovado'){
        echo Html::a('Consulta', ['consulta/create', 'id' => $model->id, 'data' => $model->date, 'id_utente' => $model->id_utente], ['class' => 'btn btn-primary']) ;
    }
    if($model->status == 'Em Espera'){
        echo Html::a('Alterar', ['marcacao-consulta/update', 'id' => $model->id, 'data' => $model->date], ['class' => 'btn btn-primary']) ;
    }
    ?>
    &nbsp;&nbsp;&nbsp;
    <?= Html::a('Voltar para trás', ['grid'], ['class' => 'btn btn-success']) ?>

</div>
