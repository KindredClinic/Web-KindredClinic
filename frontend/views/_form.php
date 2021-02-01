<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Livro */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="livro-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'isbm')->textInput() ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
