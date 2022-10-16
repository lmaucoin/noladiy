<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Inflector;

foreach($contents as $content) {
  $form = ActiveForm::begin();
  echo Html::activeHiddenInput($content, "id");
  echo "<h3>" . Inflector::humanize(str_replace("-", ": ", $content->name), true) . "<h/h3>";
  echo $form->field($content, 'content')->textarea(['rows' => '6'])->label(""); ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
<?php
  ActiveForm::end();
}

