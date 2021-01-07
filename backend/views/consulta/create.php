<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Consulta */

$this->title = 'Consulta';
?>
<div class="consulta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
