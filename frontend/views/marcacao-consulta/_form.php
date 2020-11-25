<?php

use backend\models\Especialidade;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model common\models\MarcacaoConsulta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marcacao-consulta-form">

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

<!--    /*= $form->field($model , 'id_especialidade')->dropDownList(
            \yii\helpers\ArrayHelper::map(\backend\models\Especialidade::find()->all(),
                'id',
                'tipo'),
            ['class' => 'form-control inline-block']
    )

     $form->field($model , 'id_medico')->dropDownList(
    \yii\helpers\ArrayHelper::map(\backend\models\Medicos::find()->all(),
        'id_especialidade',
        'nome'),
    ['class' => 'form-control inline-block'])
     */ -->

    <?= $form->field($model , 'id_especialidade')->dropDownList(Especialidade::dropdown(),
        ['prompt' => 'Selecionar Especialidade', 'id' => 'id_especialidade'])
    ?>

    <?= $form->field($model, 'id_medico')->widget(DepDrop::classname(), [
        'options'=>['prompt' => 'Selecionar Medico', 'id'=>'id_medico'],
        'pluginOptions'=>[
            'depends'=>['id_especialidade'],
            'placeholder'=>'Selecionar Medico',
            'url'=>Url::to(['marcacao-consulta/subcat'])
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
