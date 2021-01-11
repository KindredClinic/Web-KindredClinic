<?php

use backend\models\Medicos;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Receita Medicas';
?>
<div class="receita-medica-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Receita Medica', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date',
            [
                'attribute' => 'id_medico',
                'value'     => 'medico.nome'
            ],
            [
                'attribute' => 'id_utente',
                'value'     => 'utente.nome'
            ],


            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
            ],

        ],
    ]); ?>


</div>
