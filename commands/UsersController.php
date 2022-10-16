<?php

namespace app\commands;
use yii\console\Controller;
use app\models\User;

class UsersController extends Controller
{
/**
 * Creates a new user.
 */
  public function actionCreate($username, $password, $email, $admin=false) {
    $user = new User;
    $user->setAttribute('username', $username);
    $hash = \Yii::$app
      ->getSecurity()
      ->generatePasswordHash($password);
    $user->setAttribute('password', $hash);
    $user->setAttribute('email', $email);
    if($admin) {
      $user->setAttribute('role', 20);
    }
    if($user->save()) {
      echo "User {$username} created.\n";
    } else {
      echo "User {$username} could not be created.\n";
      return false;
    }
  }
}
