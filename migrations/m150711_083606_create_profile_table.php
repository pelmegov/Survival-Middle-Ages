<?php
use yii\db\Schema;
use yii\db\Migration;
class m150711_083606_create_profile_table extends Migration
{
    public function safeUp()
    {
        $this->createTable(
            'profile',
            [
                'user_id' => Schema::TYPE_PK,
                'first_name' => Schema::TYPE_STRING.'(32)',
                'fish' => Schema::TYPE_INTEGER,
                'animal' => Schema::TYPE_INTEGER,
                'wood' => Schema::TYPE_INTEGER,
                'stone' => Schema::TYPE_INTEGER
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