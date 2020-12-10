<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Exame */

$this->title = 'Create Exame';
$this->params['breadcrumbs'][] = ['label' => 'Exames', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exame-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
