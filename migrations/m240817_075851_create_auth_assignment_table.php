<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%auth_assignment}}`.
 */
class m240817_075851_create_auth_assignment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if ($this->db->getTableSchema('auth_assignment', true) === null) {
            $this->createTable('auth_assignment', [
                'item_name' => $this->string(64)->notNull(),
                'user_id' => $this->integer()->notNull(),
                'created_at' => $this->timestamp()->null()->defaultValue(null),
            ], 'ENGINE=InnoDB');

            // Create the primary key
            $this->addPrimaryKey('pk-auth_assignment', 'auth_assignment', ['item_name', 'user_id']);

            // Add foreign key constraint
            $this->addForeignKey(
                'fk-auth_assignment-user_id',
                'auth_assignment',
                'user_id',
                'user',
                'id',
                'CASCADE'
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop foreign key constraint
        $this->dropForeignKey('fk-auth_assignment-user_id', 'auth_assignment');

        // Drop the primary key
        $this->dropPrimaryKey('pk-auth_assignment', 'auth_assignment');

        // Drop the table
        $this->dropTable('auth_assignment');
    }
}
