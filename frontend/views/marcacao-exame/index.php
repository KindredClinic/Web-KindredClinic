<?php

use backend\models\Medicos;
use common\models\MarcacaoExame;
use common\models\Utente;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Marcação Exames';
?>


<div class="marcacao-exame-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ver Exames', ['grid'], ['class' => 'btn btn-success']) ?>
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
