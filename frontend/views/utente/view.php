<?php

use common\models\Utente;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Utente */

$this->title = 'Utente: '.$model->nome;
\yii\web\YiiAsset::register($this);
?>

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
