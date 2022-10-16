<?php

use yii\db\Migration;

/**
 * Class m221013_042743_add_content_table
 */
class m221013_042743_add_content_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%content}}', [
          'id' => $this->primaryKey(),
          'name' => $this->string()->notNull(),
          'content' => $this->text()->notNull(),
          'created_at' => $this->timestamp(),
          'updated_at' => $this->timestamp()
                               ->defaultValue(null)
                               ->append('ON UPDATE CURRENT_TIMESTAMP')
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%content}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221013_042743_add_content_table cannot be reverted.\n";

        return false;
    }
    */
}
