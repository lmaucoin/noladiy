<?php

use yii\db\Migration;
use app\models\Content;

/**
 * Class m221014_034407_import_default_content
 */
class m221014_034407_import_default_content extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      foreach($this->content as $entry) {
        $item = new Content([
          'name' => $entry['name'],
          'content' => $entry['content']
        ]);
        $item->save();
      }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      Content::deleteAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221014_034407_import_default_content cannot be reverted.\n";

        return false;
    }
    */

    public $content = [
        [
          'name' => 'home-updates',
          'content' => "As if you needed any other reason to register on the NOLADIY forum, we now have special features on the site that are available only to registered users. If you are logged in while viewing the events calendar, click the \"Remind Me\" link next to each event to request a personal email reminder prior to the show. Never forget about a show again! Every 100th email reminder will be written personally by Trey and Bryan."
        ],
        [
          'name' => 'home-contact',
          'content' => '<ul>
              <li>To submit your show to the Event Listing, <a href="/event/create">click here</a>. To get your local band listed on the New Orleans Bands Page, <a href="submit_band.php">click here</a>. <br>
              </li>
              <li><a href="mailto:flyerstorm@yahoo.com">Bryan</a> can help you with site updates and show/event/venue/booking questions. <a href="mailto:flyerstorm@yahoo.com">flyerstorm@yahoo.com</a>
              </li></ul>'
        ],
        [
          'name' => 'event-index',
          'content' => '<p>This list is an events calendar of [loosely] DIY activities in New Orleans.&nbsp; This calendar includes music shows, independent theater, activist and other types of meetings, etc.&nbsp;You will not find a listing for the House of Blues.&nbsp; The only way we can keep this list accurate and up-to-date is if you <a href="/event/create">keep us informed</a>.&nbsp; We can\'t spend every waking hour searching the internet and looking for flyers.&nbsp; Tell us what\'s going on! <a href="/event/create">Submit your show</a> to get it listed.</p>'
        ],
        [
          'name' => 'event-create',
          'content' => '<p>The event will appear on the <a href="/events">Event Listing page</a> soon if it is approved.</p>'
        ],
        [
          'name' => 'venue-index',
          'content' => 'Empty'
        ],
        [
          'name' => 'venue-create',
          'content' => 'Empty'
        ],
        [
          'name' => 'band-index',
          'content' => 'Empty'
        ],
        [
          'name' => 'band-create',
          'content' => 'Empty'
        ],
        [
          'name' => 'misc-index',
          'content' => '<font size="2" face="Courier New">Updated 01.24.15 (if anyone has any more
    information that should be up here, <a href="mailto:flyerstorm@yahoo.com"> please email
    Bryan</a>)</font>'
        ],
        [
          'name' => 'user-create',
          'content' => 'Empty'
        ]
    ];

}
