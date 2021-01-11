<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Receitas Medicas';
?>
<div class="receita-medica-index">

    <h1><?= Html::encode($this->title) ?></h1>

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
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],

        ],
    ]); ?>


</div>
