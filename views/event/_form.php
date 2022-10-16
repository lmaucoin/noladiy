<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Venue;
use app\models\User;

/** @var yii\web\View $this */
/** @var app\models\Events $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="events-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
      <div class="col-12 col-lg-6">
        <h2>Required Info</h2>
        <div class="row">
          <div class="col-12">
            <?= $form->field($model, 'title')
                     ->textInput(['maxlength' => true])
                     ->label("Performers/Performances/Title")
    ?>
          </div>
        </div>
        <div class="row">
          <div class="col-12">

    <?= $form->field($model, 'venue_id')
             ->dropdownList( ArrayHelper::map($venues, "id", "name"), ['prompt' => ""])
             ->label("Venue")
    ?>
          </div>
          <div class="w-100"></div>
          <div class="col-12">
            <?= $form->field($model, 'venue_other')
                     ->textInput(['maxlength' => true])
                     ->label("Other Venue")
                     ->hint("If the venue isn't in the menu above, add a name here. Be sure to add an address in the description.")
    ?>
          </div>
        </div>

        <div class="row">
          <div class="col-12 col-lg-6">
<?= $form->field($model, 'date')
         ->textInput()
         ->label("Event Date")
?>
          </div>
          <div class="col-12 col-lg-6">
<?= $form->field($model, 'booking_email')
         ->textInput([
           'maxlength' => true
         ])
         ->label("Your Email")
?>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <p>You will only be contacted if I have specific questions about the event you are submitting. You will never be contacted in any other way.</p>
          </div>
        </div>
        <?php if($isAdmin && Yii::$app->controller->action->id != "create") { ?>
          <div class="row">
            <div class="col-12 col-lg-6">
<?= $form->field($model, 'status')
         ->dropdownList([
           "pending" => "Pending Approval",
           "approved" => "Approved",
         ])
         ->label("Status")
?>
          </div>
          </div>
          <?php } ?>
            <?= $form->field($model, 'message')->textInput(['maxlength' => true]) ?>

      </div>
      <div class="col-12 col-lg-6">
        <h2>Optional Info</h2>
        <div class="row">
          <div class="col-12 col-lg-6">
            <?= $form->field($model, 'price')
                     ->textInput([
                       'maxlength' => true,
                       'type' => "number",
                       'step' => "0.01"

                     ]) ?>
          </div>
          <div class="col-12 col-lg-6">
            <?= $form->field($model, 'start_time')
                     ->textInput(['type'=>'time'])
                     ->hint("HH:MM AM/PM");
?>
          </div>
        </div>
        <?= $form
          ->field($model, 'min_age')
          ->dropdownList([
            "Don't Know" => "Don't Know",
            "All Ages"   => "All Ages",
            "18+" => "18+",
            "21+" => "21+"
          ]) ?>
        <div class="row">
          <div class="col-12">
            <?= $form
              ->field($model, 'description')
              ->textarea(['rows' => 5])
              ->hint(" Examples: a minimal bio, directions to the venue, or pertinent web links. Extraneous info will be edited or removed. ");
?>
          </div>
        </div>
      </div>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
