<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Venues $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="venues-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
      <div class="col-12 col-lg-6">
        <h2>Required Info</h2>
        <?= $form->field($model, 'name')
                 ->textInput(['maxlength' => true])
                 ->label('Venue Name') ?>
        <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>
        <div class="row">
          <div class="col-12 col-lg-6">
            <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
          </div>
          <div class="col-12 col-md-6 col-lg-3">
            <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>
          </div>
          <div class="col-12 col-md-6 col-lg-3">
            <?= $form->field($model, 'zip')->textInput(['maxlength' => true]) ?>
          </div>
          <div class="col-12 col-lg-6">
          <?= $form->field($model, 'region')
                   ->dropdownList( [
                     "New Orleans" => "New Orleans",
                     "Baton Rouge" => "Baton Rouge",
                     "Lafayette" => "Lafayette",
                     "Slidell" => "Slidell",
                     "West Monroe" => "West Monroe",
                     "Shreveport" => "Shreveport",
                     "Mandeville/Covington" => "Mandeville/Covington",
                     "Lake Charles" => "Lake Charles",
                     "Thibodaux" => "Thibodaux",
                     "Houma" => "Houma",
                     "Other" => "Other"
                   ], ['prompt' => ""])
                   ->label("General Region (Choose One)") ?>
          </div>
          <div class="col-12 col-lg-6">
    <?= $form->field($model, 'all_ages')
             ->radioList(["Yes", "No"])
             ->label("All Ages?") ?>
          </div>
          <?= $form->field($model, 'description')->textarea(['rows' => 5]) ?>
        </div>
      </div>
      <div class="col-12 col-lg-6">
        <h2>Optional Info</h2>
        <div class="row">
          <div class="col-12 col-lg-6">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
          </div>
          <div class="col-12 col-lg-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
          </div>
        </div>
        <?= $form->field($model, 'url')
                 ->textInput(['maxlength' => true])
                 ->label("External Link") ?>

        <?= $form->field($model, 'facebook')
                 ->textInput(['maxlength' => true])
                 ->label("Facebook URL") ?>

         <?= $form->field($model, 'instagram')
                  ->textInput(['maxlength' => true])
                  ->label("Instagram URL") ?>

         <?= $form->field($model, 'twitter')
                  ->textInput(['maxlength' => true])
                  ->label("Twitter URL") ?>


      </div>
    </div>





    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
