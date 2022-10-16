<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%users}}`.
 */
class m221009_001542_add_role_column_to_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->addColumn(
        '{{%users}}',
        'role',
        $this->integer()->defaultValue(10)->notNull()
      );

      $this->addColumn(
        '{{%users}}',
        'created_at',
        $this->timestamp()
      );
      $this->addColumn(
        '{{%users}}',
        'updated_at',
        $this->timestamp()
          ->defaultValue(null)
          ->append('ON UPDATE CURRENT_TIMESTAMP')
      );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropColumn(
        '{{%users}}',
        'role'
      );
      $this->dropColumn(
        '{{%users}}',
        'created_at'
      );
      $this->dropColumn(
        '{{%users}}',
        'updated_at'
      );
    }
}
