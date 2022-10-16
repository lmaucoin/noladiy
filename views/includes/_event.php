<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\User;

$isAdmin = !Yii::$app->user->isGuest && User::isUserAdmin(\Yii::$app->user->identity->username);
?>
<a href="<?= Url::to(['view', 'id' => $event->id]); ?>">
  <?= Html::encode($event->title); ?>
</a>
<?php if($isAdmin) { ?>
<a href="<?= Url::to(['utility/edit-event', 'id' => $event->id]) ?>" class="btn btn-sm btn-secondary btn-event-admin">Edit</a>
<?php } ?>
<br>
<?= $event->formattedDate() ? "{$event->formattedDate()}. " : ""; ?>
<?= $event->getVenueOutput(); ?>.
<?= $event->formattedTime() ? "{$event->formattedTime()}. " : ""; ?>
<?= $event->formattedPrice(); ?>
<br>
<?= Html::encode($event->description); ?>
