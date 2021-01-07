<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MarcacaoExame */

$this->title = 'Alteração da Marcação do Exame: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Marcacao Exames', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="marcacao-exame-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
