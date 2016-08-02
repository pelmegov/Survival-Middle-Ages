<?php
use yii\db\Schema;
use yii\db\Migration;
class m200000_000000_profile extends Migration
{
    public function safeUp()
    {
        $this->createTable(
            'profile',
            [
                'user_id' => Schema::TYPE_PK,
                'nickname' => Schema::TYPE_STRING.'(32)'
            ]
        );
        $this->addForeignKey('profile_user', 'profile', 'user_id', 'user', 'id', 'cascade', 'cascade');
    }
    public function safeDown()
    {
        $this->dropForeignKey('profile_user', 'profile');
        $this->dropTable('profile');
    }

}