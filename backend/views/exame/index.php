<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exames';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exame-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Exame', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'conteudo',
            'date',
            'id_medico',
            'id_marcacao',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
