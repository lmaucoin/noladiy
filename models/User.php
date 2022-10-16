<?php
/**
 * Look, everything here is just ripped off from
 * https://www.yiiframework.com/doc/guide/2.0/en/security-authentication
 * so don't be surprised!!!
 */
namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    const ROLE_USER = 10;
    const ROLE_ADMIN = 20;

    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
          [['username', 'email', 'password'], 'required'],
          [['email'], 'email'],
          [['username', 'password', 'first_name', 'last_name'], 'string', 'max' => 255],
          ['role', 'default', 'value' => 10],
          ['role', 'in', 'range' => [self::ROLE_USER, self::ROLE_ADMIN]],
        ];
    }

    

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

        /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool|null if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function beforeSave($insert)
    {
      if (parent::beforeSave($insert)) {
        if ($this->isNewRecord) {
          $this->auth_key = \Yii::$app->security->generateRandomString();
        }
        return true;
      }
      return false;
    }

    public static function isUserAdmin($username)
    {
      if (static::findOne(['username' => $username, 'role' => self::ROLE_ADMIN])){
        return true;
      } else {
        return false;
      }

    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password) {
      return \Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public function hashPassword() {
      $hash = \Yii::$app
        ->getSecurity()
        ->generatePasswordHash($this->password);
      $this->password = $hash;
    }
}
