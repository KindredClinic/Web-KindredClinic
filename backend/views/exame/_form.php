<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Exame */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exame-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'conteudo')->textInput(['maxlength' => true]) ?>

    <?=  $form->field($model, 'date')->widget(DateTimePicker::className(),[
        'name' => 'date',
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd hh:ii:ss'
        ]
    ]);
    ?>

    <?= $form->field($model, 'id_medico')->textInput() ?>

    <?= $form->field($model, 'id_marcacao')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
