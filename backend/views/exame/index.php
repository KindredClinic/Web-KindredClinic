<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exames';
?>
<div class="exame-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ver Calendario', ['marcacao-exame/index'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'date',
            [
                'attribute' => 'id_medico',
                'value'     => 'medico.nome'
            ],
            [
                'attribute' => 'Utente',
                'value'     => 'marcacao.utente.nome'
            ],

            [
                    'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]);

    ?>


</div>
