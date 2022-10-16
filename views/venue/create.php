<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Venues $model */

$this->title = 'NOLADIY.ORG - Submit a New Venue';
?>
<div class="venues-create form-page">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">NOLADIY.ORG</a></li>
      <li class="breadcrumb-item"><a href="/venues/">Venues</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add</li>
    </ol>
  </nav>

    <h1><?= Html::encode($this->title) ?></h1>
    <?= ($content && $content != "Empty") ? $content : "<p>If the venue is approved, it will be added to <a href=\"/venues\">the list of venues</a>.</p>"; ?> 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
