<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MarcacaoConsulta */

$this->title = $model->date;
$this->params['breadcrumbs'][] = ['label' => 'Marcacao Consultas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="marcacao-consulta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'date',
            [

                'attribute'=>'id_medico',

                'value'=>$model->medico->nome

            ],
            [

                'attribute'=>'id_especialidade',

                'value'=>$model->especialidade->tipo

            ],
            [

                'attribute'=>'id_utente',

                'value'=>$model->utente->nome

            ],

        ],

    ]) ?>

</div>
