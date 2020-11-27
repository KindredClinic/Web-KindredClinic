<?php

/* @var $this yii\web\View */

use yii\bootstrap\Carousel;

$this->title = 'Kindred Clinic';
?>
<div class="site-index">

    <div class="body-content">

        <?php

        $url_images = yii\helpers\Url::to('@web/images/');

        echo Carousel::widget(['items' =>
            [['content' => '<img src="' . $url_images . '/background1.jpg"/>',
                'options' => ['style' => 'width: 100%; height: 550px;']],
                ['content' => '<img src="' .  $url_images . '/background2.jpg"/>',
                    'options' => ['style' => 'width: 100%; height: 550px;']],
                ['content' => '<img src="' .  $url_images . '/background3.jpg"/>',
                    'options' => ['style' => 'width: 100%; height: 550px;']],
                ['content' => '<img src="' .  $url_images . '/background4.jpg"/>',
                    'options' => ['style' => 'width: 100%; height: 550px;']],
                ['content' => '<img src="' .  $url_images . '/background5.jpg"/>',
                    'options' => ['style' => 'width: 100%; height: 550px;']]],
        ]);
        ?>

    </div>

    <div class="row">
        <div class="column">
            <div class="card">
                <h2 class="titulo">Sobre</h2>
                <h4> A Kindred Clinic centra-se no seu conforto e bem estar, além das suas necessidades médicas.</h4>
                <h4> Estamos sempre disponiveis para atender às suas necessidades, a qualquer dia e a qualquer hora.</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="column">
            <div class="card">
                <h2 class="titulo">O porquê de escolher a nossa clinica</h2>
                <h4> Na nossa clinica acreditamos que o bem estar dos nossos pacientes ajuda para a sua recuperação. Assim cada utente tem um enfermeiro/enfermeira sempre ao seu dispor.</h4>
                <h4> Ainda acreditamos que uma boa hospitalidade ajuda ao bem estar psicológico do utente.</h4>
            </div>
        </div>
    </div>

</div>
