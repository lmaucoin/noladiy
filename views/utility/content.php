<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ActiveForm;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'NOLADIY.ORG - Content Administration';
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">NOLADIY.ORG</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="/utility">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Content</li>
  </ol>
</nav>
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
