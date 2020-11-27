<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MarcacaoExame */

$this->title = 'Create Marcacao Exame';
$this->params['breadcrumbs'][] = ['label' => 'Marcacao Exames', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marcacao-exame-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
