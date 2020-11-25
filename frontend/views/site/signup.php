<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\Utente */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $form yii\widgets\ActiveForm */

$this->title = 'Registar';
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Por favor preencha os campos seguintes para se registar:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'nif')->textInput() ?>

                <?= $form->field($model, 'sexo')->dropDownList([ 'Masculino' => 'Masculino', 'Feminino' => 'Feminino', ], ['prompt' => '']) ?>

                <?= $form->field($model, 'telemovel')->textInput() ?>

                <?= $form->field($model, 'morada')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'num_sns')->textInput() ?>

                <?= $form->field($model, 'username')->textInput() ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Registar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
