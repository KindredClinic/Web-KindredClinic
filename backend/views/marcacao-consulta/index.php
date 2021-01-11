    <?php

    use backend\models\Medicos;
    use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Marcação de Consultas';
?>
<div class="marcacao-consulta-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Consulta', ['create'], ['class' => 'btn btn-success']) ?>

        <?= Html::a('Ver Consultas', ['grid'], ['class' => 'btn btn-success']) ?>

        <?= Html::a('Consultas Passadas', ['consulta/index'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= yii2fullcalendar\yii2fullcalendar::widget(array(
            'events' => $events,
            'options' => [
                'lang' => 'pt-br',
                //... more options to be defined here!
            ],

        )
    );
    ?>

</div>
