<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Medicos';
?>
<div class="medicos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Inserir Medico', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nome',
            'sexo',
            'nif',
            'telefone',
            //'email:email',
            //'num_ordem_medico',
            //'id_especialidade',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
