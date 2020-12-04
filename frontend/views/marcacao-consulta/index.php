<?php

use common\models\MarcacaoConsulta;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Marcação de Consulta';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marcacao-consulta-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Consulta', ['create'], ['class' => 'btn btn-success']) ?>
        &nbsp;&nbsp;
        <?= Html::a('Ver Consultas', ['grid'], ['class' => 'btn btn-success']) ?>
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
