<?php

use yii\db\Migration;

/**
 * Class m220930_035632_init_rbac
 */
class m220930_035632_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $auth = Yii::$app->authManager;

      $createEvent = $auth->createPermission('createEvent');
      $createEvent->description = 'Create an event';
      $auth->add($createEvent);

      $updateEvent = $auth->createPermission('updateEvent');
      $updateEvent->description = 'Update an event';
      $auth->add($updateEvent);

      $createVenue = $auth->createPermission('createVenue');
      $createVenue->description = "Create a new venue";
      $auth->add($createVenue);

      $updateVenue = $auth->createPermission('updateVenue');
      $updateVenue->description = "Update a venue's details";
      $auth->add($updateVenue);

      $updateArtist = $auth->createPermission('updateArtist');
      $updateArtist->description = "Update an artist's details";
      $auth->add($updateArtist);

      $venue  = $auth->createRole('venue');
      $auth->add($venue);
      $auth->addChild($venue, $createEvent);

      $booker = $auth->createRole('booker');
      $auth->add($booker);
      $auth->addChild($booker, $createEvent);

      $artist = $auth->createRole('artist');
      $auth->add($artist);
      $auth->addChild($artist, $createEvent);

      $admin  = $auth->createRole('admin');
      $auth->add($admin);
      $auth->addChild($admin, $createEvent);
      $auth->addChild($admin, $updateEvent);
      $auth->addChild($admin, $createVenue);
      $auth->addChild($admin, $updateVenue);
      $auth->addChild($admin, $updateArtist);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $auth = Yii::$app->authManager;
      $auth->removeAll();
    }

}
