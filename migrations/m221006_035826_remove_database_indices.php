<?php

use yii\db\Migration;

/**
 * Class m221006_035826_remove_database_indices
 */
class m221006_035826_remove_database_indices extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->alterColumn('events', 'booking_name', $this->string(255));
      $this->alterColumn('events', 'description',  $this->string(255));
      $this->alterColumn('events', 'start_time',   $this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      // We actually don't want to revert these lol
      $this->alterColumn('events', 'booking_name', $this->string(255)->notNull());
      $this->alterColumn('events', 'description',  $this->string(255)->notNull());
      $this->alterColumn('events', 'start_time',   $this->string(255)->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221006_035826_remove_database_indices cannot be reverted.\n";

        return false;
    }
    */
}
