<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `task_tracker`.
 */
class m160904_105524_create_task_tracker_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('task_tracker', [
            'id' => $this->primaryKey(),
            'profile_id' => $this->integer(),
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'text' => Schema::TYPE_TEXT,
            'status' => Schema::TYPE_INTEGER,
            'responsible' => Schema::TYPE_INTEGER,
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->insert('{{task_tracker}}', [
            'id' => '1',
            'profile_id' => '1',
            'title' => "Таск #1",
            'text' => "Тест таска №1.",
            'status' => 1,
            'responsible' => 1,
            'created_at' => time(),
        ]);

        $this->addForeignKey('task_profile', 'task_tracker', 'profile_id', 'profile', 'user_id', 'cascade', 'cascade');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('task_profile', 'task_tracker');
        $this->dropTable('task_tracker');
    }
}
