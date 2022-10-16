<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%venues}}`.
 */
class m220929_033417_create_venues_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%venues}}', [
          'id' => $this->primaryKey(),
          'name' => $this->string()->notNull(),
          'street' => $this->string()->notNull(),
          'city' => $this->string()->notNull(),
          'state' => $this->string()->notNull(),
          'zip' => $this->string()->notNull(),
          'phone' => $this->string(),
          'email' => $this->string(),
          'all_ages' => $this->boolean(),
          'url' => $this->string(),
          'facebook' => $this->string(),
          'instagram' => $this->string(),
          'twitter' => $this->string(),
          'description' => $this->text()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%venues}}');
    }
}
