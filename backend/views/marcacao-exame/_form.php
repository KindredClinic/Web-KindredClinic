<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MarcacaoExame */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marcacao-exame-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'id_medico')->textInput() ?>

    <?= $form->field($model, 'id_utente')->textInput() ?>

    <?= $form->field($model, 'id_especialidade')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
