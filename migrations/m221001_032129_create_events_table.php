<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%events}}`.
 */
class m221001_032129_create_events_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%events}}', [
            'id' => $this->primaryKey(),
            'venue_id' => $this->integer(),
            'venue_other' => $this->string(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'price' => $this->string(),
            'date' => $this->date()->notNull(),
            'start_time' => $this->time()->notNull(),
            'min_age' => $this->string(),
            'booking_name' => $this->string()->notNull(),
            'booking_email' => $this->string()->notNull(),
            'external_link' => $this->string(),
        ]);

        // Foreign key for venues table
        $this->createIndex(
            'idx-events-venue_id',
            '{{%events}}',
            'venue_id'
        );
        $this->addForeignKey(
            'fk-events-venue_id',
            '{{%events}}',
            'venue_id',
            'venues',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%events}}');
    }
}
