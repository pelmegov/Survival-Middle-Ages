<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `avatar`.
 */
class m160905_131108_create_avatar_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('avatar', [
            'id' => Schema::TYPE_PK,
            'link' => Schema::TYPE_STRING . ' NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'cost' => Schema::TYPE_INTEGER,
        ]);

        $this->insert('{{avatar}}', [
            'id' => '1',
            'link' => 'images/avatars/0.jpg',
            'name' => 'Человек без имени',
            'cost' => '0'
        ]);

        $this->insert('{{avatar}}', [
            'id' => '2',
            'link' => 'images/avatars/1.png',
            'name' => 'Рыцарь',
            'cost' => '20'
        ]);

        $this->insert('{{avatar}}', [
            'id' => '3',
            'link' => 'images/avatars/2.jpg',
            'name' => 'Чумной доктор',
            'cost' => '40'
        ]);

        $this->insert('{{avatar}}', [
            'id' => '4',
            'link' => 'images/avatars/3.jpg',
            'name' => 'Вор',
            'cost' => '25'
        ]);

        $this->insert('{{avatar}}', [
            'id' => '5',
            'link' => 'images/avatars/4.jpg',
            'name' => 'Миледи',
            'cost' => '20'
        ]);

        $this->insert('{{avatar}}', [
            'id' => '6',
            'link' => 'images/avatars/5.png',
            'name' => 'Лекарь',
            'cost' => '30'
        ]);

        $this->insert('{{avatar}}', [
            'id' => '7',
            'link' => 'images/avatars/6.jpg',
            'name' => 'Кузнец',
            'cost' => '30'
        ]);

        $this->insert('{{avatar}}', [
            'id' => '8',
            'link' => 'images/avatars/7.jpg',
            'name' => 'Торговец',
            'cost' => '35'
        ]);

        $this->addForeignKey('avatar_profile', 'profile', 'avatar_id', 'avatar', 'id', 'cascade', 'cascade');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('avatar_profile', 'profile');
        $this->dropTable('avatar');
    }
}
