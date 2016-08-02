<?php
/**
 * Created by PhpStorm.
 * User: user2
 * Date: 02.08.2016
 * Time: 13:18
 */
use yii\db\Schema;
use yii\db\Migration;
class m300000_000000_user_resource extends Migration
{
    public function safeUp()
    {
        $this->createTable(
            'user_resource',
            [
                'user_id' => 'int NOT NULL',
                'resource_id' => 'int NOT NULL',
                'amount' => Schema::TYPE_INTEGER,
                'time_start' => Schema::TYPE_INTEGER,
                'PRIMARY KEY (`user_id`, `resource_id`)'
            ]
        );

        $this->addForeignKey('user_resource', 'user_resource', 'user_id', 'user', 'id', 'cascade', 'cascade');
    }
    public function safeDown()
    {
//        $this->dropForeignKey('profile_user', 'profile');
//        $this->dropTable('profile');
    }

}