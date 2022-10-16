<?php

use yii\db\Migration;

/**
 * Class m221007_222752_create_new_columns
 */
class m221007_222752_create_new_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

      $this->addColumn(
        '{{%events}}',
        'created_at',
        $this->timestamp()
      );
      $this->addColumn(
        '{{%events}}',
        'updated_at',
        $this->timestamp()
          ->defaultValue(null)
          ->append('ON UPDATE CURRENT_TIMESTAMP')
      );
      $this->addColumn(
        '{{%events}}',
        'status',
        $this->string()->defaultValue("pending")->notNull()
      );

      $this->addColumn(
        '{{%venues}}',
        'created_at',
        $this->timestamp()
      );
      $this->addColumn(
        '{{%venues}}',
        'updated_at',
        $this->timestamp()
          ->defaultValue(null)
          ->append('ON UPDATE CURRENT_TIMESTAMP')
      );
      $this->addColumn(
        '{{%venues}}',
        'status',
        $this->string()->defaultValue("pending")->notNull()
      );
      $this->addColumn(
        '{{%venues}}',
        'region',
        $this->string()->notNull()
      );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropColumn(
        '{{%events}}',
        'created_at'
      );
      $this->dropColumn(
        '{{%events}}',
        'updated_at'
      );
      $this->dropColumn(
        '{{%events}}',
        'status'
      );
      $this->dropColumn(
        '{{%venues}}',
        'updated_at'
      );
      $this->dropColumn(
        '{{%venues}}',
        'status'
      );
      $this->dropColumn(
        '{{%venues}}',
        'region'
      );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221007_222752_create_new_columns cannot be reverted.\n";

        return false;
    }
    */
}
