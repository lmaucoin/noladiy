<?php

namespace app\models;

use Yii;
use \yii\helpers\Html;
use \yii\db\Expression;
use \yii\helpers\Url;

/**
 * This is the model class for table "events".
 *
 * @property int $id
 * @property int|null $venue_id
 * @property string|null $venue_other
 * @property string $title
 * @property string $description
 * @property string|null $price
 * @property string $date
 * @property string $start_time
 * @property string|null $min_age
 * @property string $booking_name
 * @property string $booking_email
 * @property string|null $external_link
 *
 * @property Venue $venue
 */
class Event extends \yii\db\ActiveRecord
{

  /**
   * @property string $message
   * This shouldn't have a value lol
   */
    public $message;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['venue_id'], 'integer'],
            [['title', 'date', 'booking_email'], 'required'],
            [['description'], 'string'],
            [['date', 'start_time'], 'safe'],
            [['venue_other', 'title', 'min_age', 'booking_name', 'booking_email', 'external_link'], 'string', 'max' => 255],
            [['venue_id'], 'exist', 'skipOnError' => true, 'targetClass' => Venue::class, 'targetAttribute' => ['venue_id' => 'id']],
            [['price'], 'number'],
            [['booking_email'], 'email'],
            [['description','title','booking_name'], 'filter', 'filter' => function($value) {
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
            'venue_id' => 'Venue ID',
            'venue_other' => 'Venue Other',
            'title' => 'Title',
            'description' => 'Description',
            'price' => 'Price',
            'date' => 'Date',
            'start_time' => 'Start Time',
            'min_age' => 'Min Age',
            'booking_name' => 'Booking Name',
            'booking_email' => 'Booking Email',
            'external_link' => 'External Link',
        ];
    }

    /**
     * Gets query for [[Venue]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVenue()
    {
       $venueQuery = $this->hasOne(Venue::class, ['id' => 'venue_id']);
       $venueName = $venueQuery->one() ?? $this->venue_other;
       return $venueName;
    }

    public function getVenueOutput() {
      $venue = $this->getVenue();
      if(gettype($venue) === "string") {
        return Html::encode($venue);
      } else {
        $venueName = Html::encode($venue->name);
        return '<a href="' . Url::to(['venue/view', 'id' => $venue->id]) . "\">{$venueName}</a>";
      }
    }

    public static function getCurrentEvents() {
      return Event::find()
        ->where(['=', 'date', new Expression('NOW()')])
        ->all();
    }

    public static function getFutureEvents() {
      return Event::find()
        ->where(['>', 'date', new Expression('NOW()')])
        ->andWhere(['status' => 'approved'])
        ->orderBy('date ASC')
        ->all();

    }

    public static function getPendingEvents() {
      return Event::find()
        ->where(['>', 'date', new Expression('NOW()')])
        ->andWhere(['=', 'status', 'pending'])
        ->orderBy('date ASC')
        ->all();
    }
    public static function findById($id) {
      return Event::find()
        ->where(['id' => $id])
        ->one();
    }

    public function formattedDate() {
      return (new \DateTime($this->date))->format("l M j, Y");
    }

    public function formattedPrice() {
      return $this->price ? "\${$this->price}." : "";
    }

    public function formattedTime() {
      $timeFormat = "/\d\d:\d\d:\d\d/";
      if(preg_match($timeFormat, $this->start_time)) {
        return (new \DateTime($this->start_time))->format("g:i A");
      }
    }

}
