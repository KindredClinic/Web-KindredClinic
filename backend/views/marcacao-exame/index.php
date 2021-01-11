<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Marcação de Exames';
?>
<div class="marcacao-exame-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Exame', ['create'], ['class' => 'btn btn-success']) ?>

        <?= Html::a('Ver Exames', ['grid'], ['class' => 'btn btn-success']) ?>

        <?= Html::a('Exames Passados', ['exame/index'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= yii2fullcalendar\yii2fullcalendar::widget(array(
            'events' => $events,
            'options' => [
                'lang' => 'pt-br',
                //... more options to be defined here!
            ],

        )
    );
    ?>


</div>
