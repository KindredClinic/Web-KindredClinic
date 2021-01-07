<?php

use backend\models\Medicos;
use common\models\Medicamentos;
use common\models\Utente;
use kartik\select2\Select2;
use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ReceitaMedica */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="receita-medica-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
      $form->field($model, 'id_utente')->widget(Select2::classname(), [
        'data' => Utente::dropdown(),
        'options' => ['placeholder' => 'Selecione o Utente ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <?=
    $form->field($model, 'id_medicamento')->widget(Select2::classname(), [
        'data' => Medicamentos::dropdown(),
        'options' => ['placeholder' => 'Selecione o Medicamento ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <?= $form->field($model, 'conteudo')->widget(Widget::className(), [
        'name' => 'conteudo',
        'settings' => [
            'lang' => 'en',
            'minHeight' => 250,
            'buttons' => ['formatting','bold','italic','unorderedlist','orderedlist','outdent','indent','alignment'],
        ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
