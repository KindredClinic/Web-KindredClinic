<?php

/* @var $this yii\web\View */

use yii\bootstrap\Carousel;

$this->title = 'Kindred Clinic';
?>
<div class="site-index">

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
