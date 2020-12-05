<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MarcacaoExame */

$this->title = 'Estado do Exame: ';
\yii\web\YiiAsset::register($this);
?>
<div class="marcacao-exame-view">

    <br>

    <h1><?= Html::encode($this->title) ?></h1>
    <?=$model->changeColor($model->status)?>

    <br>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'attribute' => 'date',
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
    <?= Html::a('Voltar para trás', ['index'], ['class' => 'btn btn-success']) ?>
</div>
