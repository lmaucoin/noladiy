<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Events $model */

$this->title = 'NOLADIY.ORG - Submit a New Show';
?>
<div class="events-create form-page">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">NOLADIY.ORG</a></li>
    <li class="breadcrumb-item"><a href="/events/">Events</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add</li>
  </ol>
</nav>
    <h1>Submit a Show/Event</h1>
    <?= $eventCreateContent; ?>

    <?= $this->render('_form', [
      'model' => $model,
      'venues' => $venues,
      'isAdmin' => $isAdmin
    ]) ?>

</div>
