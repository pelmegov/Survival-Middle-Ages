<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `post`.
 */
class m160803_084605_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            'email' => Schema::TYPE_STRING . ' NOT NULL',
            'password_hash' => Schema::TYPE_STRING . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL',
            'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'secret_key' => Schema::TYPE_STRING,
            'role' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->insert('{{user}}', [
            'id' => '1',
            'username' => 'admin',
            'auth_key' => '3nOgoJfv133Lr01zmgx_YzaeItmSylLx',
            // password: 123456
            'password_hash' => '$2y$13$lzqZ3tbLMemSDh1.AvezbOudvA/uhlVIOJRkYE080Akgryhz1NIBO',
            'email' => 'admin@mail.ru',
            'role' => '20',
            'status' => '10',
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
