<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Events $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">NOLADIY.ORG</a></li>
    <li class="breadcrumb-item"><a href="/events">Events</a></li>
    <li class="breadcrumb-item active" aria-current="page">
      <?= Html::encode($this->title) ?>
    </li>
  </ol>
</nav>
<div class="events-view">
  <div class="row">
    <div class="col-12 col-md-9 col-xl-10 events-description">
      <?= $this->render('/includes/_event.php', ['event' => $model]); ?>
    </div>
  </div>

</div>
