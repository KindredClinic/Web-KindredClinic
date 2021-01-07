<?php

use common\models\Medicamentos;
use kartik\markdown\MarkdownEditor;
use kartik\select2\Select2;
use vova07\imperavi\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Exame */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="exame-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'conteudo')->widget(Widget::className(), [
        'name' => 'conteudo',
        'settings' => [
            'lang' => 'en',
            'minHeight' => 250,
            'buttons' => ['formatting','bold','italic','unorderedlist','orderedlist','outdent','indent','alignment'],
        ],
    ]);
    ?>

    <?php echo '<label class="control-label">Medicamentos</label>';

    echo Select2::widget([
        'name' => 'medicamentos',
        'data' => ArrayHelper::map(Medicamentos::formAddon(), 'id', 'nome'),
        'options' => [
            'placeholder' => 'Medicamentos ...',
            'attribute' => 'Medicamentos',
            'allowClear' => true,
        ],
    ]);

    ?>

    <br>
    <br>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Ver Exames', ['index'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
