<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
$menuItems[] = ['label' => 'Utente', 'url' => ['/utente/view']];
AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<div class="utente-index">

</div>
