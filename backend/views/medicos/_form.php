<?php

use backend\models\Especialidade;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Medicos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="medicos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sexo')->dropDownList([ 'Masculino' => 'Masculino', 'Feminino' => 'Feminino', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'nif')->textInput() ?>

    <?= $form->field($model, 'telefone')->textInput() ?>

    <?= $form->field($model, 'num_ordem_medico')->textInput() ?>

    <?=
    $form->field($model, 'id_especialidade')->widget(Select2::classname(), [
        'data' => Especialidade::dropdown(),
        'options' => ['placeholder' => 'Selecione a Especialidade ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success','name' => 'save-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
