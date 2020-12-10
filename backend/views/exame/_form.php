<?php

use common\models\Medicamentos;
use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Exame */
/* @var $form yii\widgets\ActiveForm */

$medicamentos = Medicamentos::formAddon();

?>

<script>
    $('#conteudo').redactor({
        buttons:['formatting','bold','italic','unorderedlist','orderedlist','outdent','indent']
    });
</script>


<div class="exame-form">

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

    <?= $form->field($model, 'conteudo')->widget(Widget::className(), [
        'name' => 'conteudo',
        'settings' => [
            'lang' => 'en',
            'minHeight' => 250,
            'buttons' => ['formatting','bold','italic','unorderedlist','orderedlist','outdent','indent','alignment'],
        ],
    ]); ?>

    <?= $form->field($model, 'id_medico')->textInput() ?>

    <?= $form->field($model, 'id_marcacao')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
