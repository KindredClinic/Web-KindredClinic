<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ReceitaMedica */

$this->title = 'Create Receita Medica';
$this->params['breadcrumbs'][] = ['label' => 'Receita Medicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="receita-medica-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
