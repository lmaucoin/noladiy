<?php

use app\models\Venue;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\User;

$isAdmin = !Yii::$app->user->isGuest && User::isUserAdmin(\Yii::$app->user->identity->username);

/** @var yii\web\View $this */
/** @var app\models\VenuesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = "NOLADIY.ORG - New Orleans & Louisiana Venues";
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">NOLADIY.ORG</a></li>
    <li class="breadcrumb-item active" aria-current="page">Venues</li>
  </ol>
</nav>
<div class="venues-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
      <div class="col-12">
        <?php if($content && $content != "Empty") { echo $content;  } else { ?>
        <p>If you know of a venue that should be listed here, <a href="<?= Url::to(['venue/create'])?>">submit it here</a> to get it added to the list. </p>
        <?php } ?>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <?php
              for($i = 0; $i < count($regions); $i++) {
                $region = $regions[$i];
              ?>
            <li class="breadcrumb-item">
              <a href="#region-<?= $i ?>">
                <?= $region['region'] ?>
              </a>
            </li>
            <?php } ?>
          </ol>
        </nav>
      </div>
    </div>
    <hr>
    <br>
    <?php for($i = 0; $i < count($regions); $i++) {
        $region = $regions[$i]; ?>
    <?php $nameShown = false; ?>
    <?php $venues = Venue::find()
      ->where(['region' => $region['region']])
      ->orderBy('name ASC')
      ->all(); ?>
      <?php foreach($venues as $venue) { ?>
      <div class="row venue-item" id="region-<?= $i ?>">
        <div class="col-12 col-md-4 col-lg-2">
        <?php if(!$nameShown) { ?>
          <h3><?= $region['region'] ?></h3>
          <?php
            $nameShown = true;
          } ?>
        </div>
        <div class="col-12 col-md-8 col-lg-10">
          <strong>
            <a href="<?= Url::to(['venue/view', 'id' => $venue->id]) ?>"><?= $venue->name ?></a>
          </strong>
          <?php if($isAdmin) { ?>
          <a href="<?= Url::to(['venue/update', 'id' => $venue->id]) ?>" class="btn btn-sm btn-secondary btn-event-admin">Edit</a>
          <?php } ?>
          <br>
          <ul class="venue nav">
            <li><?= $venue->street ?></li>
            <li><?= $venue->zip ?> </li>
            <?php if($venue->all_ages > 0) {echo "<li>All Ages</li>"; } ?>
            <?php if($venue->phone) { echo "<li>" . $venue->phone ."</li>"; } ?>
            <?php if($venue->email) { echo "<li><a href=\"mailto:{$venue->email}\">{$venue->email}</a></li>"; } ?>
            <?php if($venue->url) { echo "<li><a target=\"_blank\" href=\"{$venue->url}\">{$venue->url}</a></li>"; } ?>
            <?php if($venue->facebook) { echo "<li><a target=\"_blank\" href=\"{$venue->facebook}\">Facebook</a></li>"; } ?>
            <?php if($venue->instagram) { echo "<li><a target=\"_blank\" href=\"{$venue->instagram}\">Instagram</a></li>"; } ?>
            <?php if($venue->twitter) { echo "<li><a target=\"_blank\" href=\"{$venue->twitter}\">Twitter</a></li>"; } ?>
          </ul>
          <?= $venue->description ?>
        </div>
      </div>
      <?php }?>
    <?php } ?>



</div>
