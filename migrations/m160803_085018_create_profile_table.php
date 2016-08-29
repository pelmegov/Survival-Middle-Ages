<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `profile`.
 */
class m160803_085018_create_profile_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('profile', [
            'user_id' => Schema::TYPE_PK,
            'nickname' => Schema::TYPE_STRING.'(32)'
        ]);

        $this->insert('{{profile}}', [
            'user_id' => '1',
            'nickname' => 'ADMINISTRATOR'
        ]);

        $this->addForeignKey('profile_user', 'profile', 'user_id', 'user', 'id', 'cascade', 'cascade');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('profile_user', 'profile');
        $this->dropTable('profile');
    }
}
