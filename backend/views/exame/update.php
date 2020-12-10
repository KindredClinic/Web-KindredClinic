<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Exame */

$this->title = 'Update Exame: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Exames', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="exame-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
