<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Events $model */

$this->title = 'Update Event - ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">NOLADIY.ORG</a></li>
    <li class="breadcrumb-item"><a href="/events">Events</a></li>
    <li class="breadcrumb-item active" aria-current="page">Update Event</li>
  </ol>
</nav>
<div class="events-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
      'model' => $model,
      'venues' => $venues,
      'isAdmin' => $isAdmin
    ]) ?>

</div>
