<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "venues".
 *
 * @property int $id
 * @property string $name
 * @property string $street
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string|null $phone
 * @property string|null $email
 * @property int|null $all_ages
 * @property string|null $url
 * @property string|null $facebook
 * @property string|null $instagram
 * @property string|null $twitter
 * @property string $description
 * @property string $region
 */
class Venue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'venues';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'street', 'city', 'state', 'zip', 'description'], 'required'],
            [['name'], 'unique'],
            [['all_ages'], 'integer'],
            [['description'], 'string'],
            [['updated_at', 'created_at'], 'safe'],
            [['name', 'street', 'city', 'state', 'zip', 'phone', 'email', 'url', 'facebook', 'instagram', 'twitter','region'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['url', 'facebook', 'instagram', 'twitter'], 'url'],
            [['description','name'], 'filter', 'filter' => function($value) {
              if($value) {
                return strip_tags($value);
              }
            }],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'street' => 'Street',
            'city' => 'City',
            'state' => 'State',
            'zip' => 'Zip',
            'phone' => 'Phone',
            'email' => 'Email',
            'all_ages' => 'All Ages',
            'url' => 'Url',
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'twitter' => 'Twitter',
            'description' => 'Description',
            'region' => 'General Region'
        ];
    }

    public static function findById($id) {
      return Venue::find()->where(['id' => $id])->one();
    }

    public static function getPendingVenues() {
      return Venue::find()->where(['status' => 'pending'])->all();
    }

    public static function getRegions() {
      $query = new Query;
      $regions = $query->select('region')
        ->distinct()
        ->from('venues')
        ->all();
      return $regions;
    }

    public function getGoogleMapsUrl() {
      $base = "https://www.google.com/maps/search/?api=1&query=";
      $geo = ($this->city && $this->state) ?
        ", {$this->city}, {$this->state}" :
        "";
      return $base . urlencode("{$this->name}{$geo}");
    }
}
