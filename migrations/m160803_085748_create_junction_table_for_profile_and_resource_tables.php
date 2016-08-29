<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `profile_resource`.
 * Has foreign keys to the tables:
 *
 * - `profile`
 * - `resource`
 */
class m160803_085748_create_junction_table_for_profile_and_resource_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('profile_resource', [
            'user_id' => $this->integer(),
            'resource_id' => $this->integer(),
            'needs_time' => Schema::TYPE_INTEGER,
            'amount' => Schema::TYPE_INTEGER,
            'PRIMARY KEY(user_id, resource_id)',
        ]);

        $this->insert('{{profile_resource}}', [
            'user_id' => '1',
            'resource_id' => '1',
            'needs_time' => 0,
            'amount' => 1000000,
        ]);

        $this->insert('{{profile_resource}}', [
            'user_id' => '1',
            'resource_id' => '2',
            'needs_time' => 0,
            'amount' => 1000,
        ]);

        $this->insert('{{profile_resource}}', [
            'user_id' => '1',
            'resource_id' => '3',
            'needs_time' => 0,
            'amount' => 1000,
        ]);

        $this->insert('{{profile_resource}}', [
            'user_id' => '1',
            'resource_id' => '4',
            'needs_time' => 0,
            'amount' => 1000,
        ]);

        $this->insert('{{profile_resource}}', [
            'user_id' => '1',
            'resource_id' => '5',
            'needs_time' => 0,
            'amount' => 1000,
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-profile_resource-user_id',
            'profile_resource',
            'user_id'
        );

        // add foreign key for table `profile`
        $this->addForeignKey(
            'fk-profile_resource-user_id',
            'profile_resource',
            'user_id',
            'profile',
            'user_id',
            'CASCADE'
        );

        // creates index for column `resource_id`
        $this->createIndex(
            'idx-profile_resource-resource_id',
            'profile_resource',
            'resource_id'
        );

        // add foreign key for table `resource`
        $this->addForeignKey(
            'fk-profile_resource-resource_id',
            'profile_resource',
            'resource_id',
            'resource',
            'resource_id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `profile`
        $this->dropForeignKey(
            'fk-profile_resource-user_id',
            'profile_resource'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-profile_resource-user_id',
            'profile_resource'
        );

        // drops foreign key for table `resource`
        $this->dropForeignKey(
            'fk-profile_resource-resource_id',
            'profile_resource'
        );

        // drops index for column `resource_id`
        $this->dropIndex(
            'idx-profile_resource-resource_id',
            'profile_resource'
        );

        $this->dropTable('profile_resource');
    }
}
