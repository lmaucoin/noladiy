<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'NOLADIY.ORG - Administration';
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">NOLADIY.ORG</a></li>
    <li class="breadcrumb-item active" aria-current="page">Admin</li>
  </ol>
</nav>
<div class="users-index">

  <div class="row mb-2">
    <div class="col-12">
    <a class="btn btn-secondary btn-sm" href="/utility/content">Edit Content</a>
    </div>
  </div>
  <h1>
    <?= Html::encode($this->title) ?>
  </h1>
    <div class="row">
      <div class="col-12 col-md-4 col-lg-3">
        <h3>Pending Venues</h3>
        <?php if($venues) { ?>
        <table class="table table-dark">
          <tbody>
            <?php foreach($venues as $venue) { ?>
            <tr>
              <td>
                <strong>
                  <a href="<?= Url::to(['venue/update', 'id' => $venue->id]) ?>"><?= $venue->name; ?></a>
                </strong>
                <br>
                <a href="<?= Url::to(['utility/approve-venue', 'id' => $venue->id]) ?>"
                   class="btn btn-success btn-sm">Approve</a>
                <a href="<?= Url::to(['utility/edit-venue', 'id' => $venue->id]) ?>" class="btn btn-secondary btn-sm">Edit</a>
                <a href="<?= Url::to(['utility/delete-venue', 'id' => $venue->id]) ?>" class="btn btn-danger btn-sm"  data-confirm="Are you sure you want to delete this item?" data-method="post">Remove</a>

              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <?php } else { ?>
        <p>No venues awaiting approval.</p>
        <?php } ?>
      </div>
      <div class="col-12 col-md-8 col-lg-9">
        <h3>Pending Events</h3>
        <?php if($events) { ?>
        <table class="table table-dark">
          <tbody>
        <?php foreach($events as $event) { ?>
        <tr>
          <td class="col-4">
            <strong>
              <a href="<?= Url::to(['utility/edit-event', 'id' => $event->id]) ?>"><?= $event->title; ?></a>
            </strong> at <?= $event->venue->name; ?>
            <br>
            <small>Submitted By: <a href="<?= $event->booking_email; ?>"><?= $event->booking_email; ?></a></small>
          </td>
          <td class="col-5">
            <?= $event->formattedDate(); ?>
            <?= $event->formattedTime(); ?>
            <br>
            <?= $event->description; ?>
          </td>
          <td class="col-3">
            <a href="<?= Url::to(['utility/approve-event', 'id' => $event->id]) ?>"
            class="btn btn-success btn-sm">Approve</a>
            <a href="<?= Url::to(['utility/edit-event', 'id' => $event->id]) ?>" class="btn btn-secondary btn-sm">Edit</a>
            <a href="<?= Url::to(['utility/delete-event', 'id' => $event->id]) ?>" class="btn btn-danger btn-sm"  data-confirm="Are you sure you want to delete this item?" data-method="post">Remove</a>

          </td>
        </tr>
        <?php } ?>
        </tbody>
        </table>
        <?php } else { ?>
        <em>No pending events that require approval.</em>
        <?php } ?>
      </div>
    </div>


</div>
