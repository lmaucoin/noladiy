<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Venues $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Venues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">NOLADIY.ORG</a></li>
    <li class="breadcrumb-item"><a href="/venues">Venues</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?=$this->title?></li>
  </ol>
</nav>
<div class="venues-view mb-4">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
      <div class="col-12 col-lg-2 col-xl-1">
        <h3>Address:</h3>
      </div>
      <div class="col-12 col-lg-10 col-xl-11">
        <p><?= $model->street ?><br>
        <?= $model->city ?>, <?= $model->state ?> <?= $model->zip ?><br>
        <small>
          (<a href="<?= $model->getGoogleMapsUrl() ?>" target="_blank">Google Maps</a>)
        </small>
        </p>
      </div>
    </div>
    <div class="row mb-4">
      <div class="col-12 col-lg-2 col-xl-1">
        <h3>Contact:</h3>
      </div>
      <div class="col-12 col-lg-10 col-xl-11">
          <?= $this->render('_contact-field', ['link' => $model->phone, 'label' => "Phone"]) ?>
          <?= $this->render('_contact-field', ['link' => $model->email, 'label' => "Email"]) ?>
          <?= $this->render('_contact-field', ['link' => $model->url, 'label' => "URL"]) ?>
          <?= $this->render('_contact-field', ['link' => $model->facebook, 'label' => "Facebook"]) ?>
          <?= $this->render('_contact-field', ['link' => $model->instagram, 'label' => "Instagram"]) ?>
          <?= $this->render('_contact-field', ['link' => $model->twitter, 'label' => "Twitter"]) ?>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-lg-2 col-xl-1">
        <h3>Notes:</h3>
      </div>
      <div class="col-12 col-lg-10 col-xl-11">
        <p><?= $model->description ?></p>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-12 col-lg-2 col-xl-1">
        <h3>Events:</h3>
      </div>
      <div class="col-12 col-lg-10 col-xl-11">
        <?php if($events) { ?>
          <?php foreach($events as $event) { ?>
          <div class="row mb-2">
            <div class="col-12">
              <?= $this->render('/includes/_event.php', ['event' => $event]); ?>
            </div>
          </div>
          <?php } ?>
        <?php } else { ?>
        <p>No upcoming events.
        <a href="<?= Url::to(['event/create']) ?>">Submit one here</a>.</p>
        <?php } ?>
      </div>
    </div>

</div>
