<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Marcação Exames';
?>
<div class="utente-index">

    <div id="SideBar" class="sidenav">

        <?= Html::a('Menu', ['/utente/index'])  ?>
        <?= Html::a('Perfil', ['/utente/view'])  ?>
        <?= Html::a('Consultas', ['/marcacao-consulta/index'])  ?>

    </div>

</div>


<div class="marcacao-exame-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
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
