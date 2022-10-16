<?php
use \yii\helpers\Html;
use \yii\helpers\Url;
$this->title =  "NOLADIY.ORG - New Orleans Events, Bands, Venues"; ?>

<div class="site-index">

    <div class="body-content">

        <div class="row">
          <div class="col-12 col-lg-4 col-xl-4">
            <h1>New Orleans Community</h1>
            <div class="navItem">
              <a href="/events">Local Shows and DIY Events</a><br>
              <a href="/venues">Venues</a>&nbsp;<br>
              <!--
                COMING SOON
              <a href="bands.php">Bands</a><br>
              <a href="booking.php">Booking/Promoters</a><br>
              <a href="miscellaneous.html">Miscellaneous</a><br>
              <a href="/forum/">Forum</a>
              -->
            </div>
          </div>
          <div class="col-12 col-lg-4 col-xl-3">
            <img src="/nola.jpg" alt="No Trends, No Cliques" class="img-fluid">
          </div>
          <div class="col-12 col-lg-4 col-xl-5 header-events mt-4">
            <h3><a href="<?= Url::to(['event/create']) ?>">Add an event to the Event Listing</a></h3>
            <h3><a href="<?= Url::to(['venue/create']) ?>">Add a venue to the Venue Listing</a></h3>
            <!--
              COMING SOON
            <h3><a href="submit_band.php">Add a  New Orleans Area Band </a></h3>
            -->
          </div>
        </div>

        <div class="row">
          <div id="home-events" class="col-12 smallEvent">
            <h3><a href="/events">Events Happening Tonight</a></h3>
            <div id="events-tonight">
              &nbsp;
<?php if ($events) {
foreach($events as $event) { ?>
                <?= $event->title; ?><br>
                <?= $event->getVenueOutput(); ?> - <?= $event->formattedTime() ?>
<?php
}
              } else {
                echo "No events today. <a href=\"/event/create/\">Want to add one</a>?";
              }
?>
            </div>
          </div>
        </div>

        <div class="row">
          <div id="home-announcements" class="col-12">
            <hr>
            <h3>Site Development</h3>
            <ul>
              <li>
                <?= $homeUpdates; ?>
              </li>
            </ul>
            <h3>Contact Info</h3>
            <?= $homeContact; ?>
              <hr>
          </div>
        </div>


    </div>
</div>
