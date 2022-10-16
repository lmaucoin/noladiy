<?php
use \yii\helpers\Html;
use \yii\helpers\Url;
$this->title = "NOLADIY.ORG - New Orleans Punk, Hardcore, Indie, and DIY Events";
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">NOLADIY.ORG</a></li>
    <li class="breadcrumb-item active" aria-current="page">Events</li>
  </ol>
</nav>

<div class="events-index">


        <div class="row">
          <div class="col-12 events-header">
            <h1>New Orleans Area DIY Events and Shows</h1>
            <?= $eventIndexContent; ?>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-12">
<?php
    $date = null;
    foreach($events as $event) { ?>
          <div class="row event-row">
            <div class="col-12 col-md-3 col-xl-2 events-date">
              <?php if($date != $event->date) { $date = $event->date; } ?>
              <?= $event->formattedDate(); ?>
            </div>
            <div class="col-12 col-md-9 col-xl-10 events-description">
              <?= $this->render('/includes/_event.php', ['event' => $event]); ?>
            </div>
          </div>
          <?php } ?>
        </div>

    </div>
</div>
