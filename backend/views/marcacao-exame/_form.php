<?php

use backend\models\Especialidade;
use common\models\Utente;
use kartik\datetime\DateTimePicker;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MarcacaoExame */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marcacao-exame-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=  $form->field($model, 'date')->widget(DateTimePicker::className(),[
        'name' => 'date',
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd hh:ii:ss'
        ]
    ]);
    ?>

    <br>
    <?= $form->field($model, 'id_utente')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Utente::formAddon(), 'id', 'nome'),
        'options' => ['placeholder' => 'Selecione o utente ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>


    <?php
        if($model->status == 'Em Espera'){
            echo $form->field($model, 'status')->dropDownList(['Aprovado' => 'Aprovado', 'Em Espera' => 'Em Espera', 'Rejeitado' => 'Rejeitado', '' => '',], ['prompt' => '']);
        }
        else{

        }
    ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        &nbsp;&nbsp;&nbsp;
        <?= Html::a('Voltar para trás', ['index'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
