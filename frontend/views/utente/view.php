<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Utente */

$this->title = 'Utente: '.$model->nome;
\yii\web\YiiAsset::register($this);
?>

<div class="utente-index">

    <div id="SideBar" class="sidenav">

        <?= Html::a('Menu', ['/utente/index'])  ?>
        <?= Html::a('Consultas', ['/marcacao-consulta/index'])  ?>
        <?= Html::a('Exames', ['/marcacao-exame/index'])  ?>
    </div>

</div>


<div class="utente-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <br>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nome',
            'nif',
            'sexo',
            'telemovel',
            'morada',
            'email:email',
            'num_sns',
        ],
    ]) ?>


</div>
