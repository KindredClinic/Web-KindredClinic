<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Marcação de Consulta';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marcacao-consulta-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Marcacao Consulta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date',
            'id_medico',
            'id_especialidade',
            'id_utente',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
