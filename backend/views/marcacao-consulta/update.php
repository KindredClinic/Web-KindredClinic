<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MarcacaoConsulta */

$this->title = 'Alteração da Marcação da Consulta: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Marcacao Consultas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="marcacao-consulta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
