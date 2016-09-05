<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `chat`.
 */
class m160905_132832_create_chat_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('chat', [
            'id' => Schema::TYPE_PK,
            'userId' => Schema::TYPE_INTEGER,
            'message' => Schema::TYPE_TEXT,
            'updateDate' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->insert('{{chat}}', [
            'id' => '1',
            'userId' => '1',
            'message' => 'Всем привет! Это первое сообщение! ',
            'updateDate' => '2016-09-05 20:14:13'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('chat');
    }
}
