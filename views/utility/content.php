<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ActiveForm;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'NOLADIY.ORG - Content Administration';
?>
<div class="utility">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
      <div class="col-12 col-xl-10">
<?= $this->render('_content-form', [
  'contents' => $contents
]) ?>
      </div>
    </div>


</div>
