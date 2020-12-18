<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Exame */

$this->title = 'Exame';
?>
<div class="exame-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
