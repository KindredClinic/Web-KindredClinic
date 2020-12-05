<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Marcação de Exames';
?>
<div class="marcacao-consulta-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ver Calendario', ['index'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'status',
                'contentOptions' => function ($model) {
                    $temp= '';
                    if($model->status == 'Aprovado'){
                        $temp = 'lightgreen';
                    }
                    elseif($model->status == 'Em Espera'){
                        $temp = 'orange';
                    }
                    elseif($model->status == 'Rejeitado'){
                        $temp = 'red';
                    }
                    return ['style' => 'background-color:'.$temp];
                },
            ],
            'status',
            'date',
            [
                'attribute' => 'id_medico',
                'value'     => 'medico.nome'
            ],
            [
                'attribute' => 'id_especialidade',
                'value'     => 'especialidade.tipo'
            ],

        ],

    ]); ?>


</div>