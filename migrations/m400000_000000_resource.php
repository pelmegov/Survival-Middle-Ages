<?php
/**
 * Created by PhpStorm.
 * User: user2
 * Date: 02.08.2016
 * Time: 13:18
 */
use yii\db\Schema;
use yii\db\Migration;
class m400000_000000_resource extends Migration
{
    public function safeUp()
    {
        $this->createTable(
            'resource',
            [
                'resource_id' => Schema::TYPE_PK,
                'resource_name' => Schema::TYPE_STRING,
                'needs_time' => Schema::TYPE_INTEGER,
                'amount' => Schema::TYPE_INTEGER
            ]
        );

        $this->insert('{{resource}}', [
            'resource_id' => '1',
            'resource_name' => 'Золото',
            'needs_time' => '0',
            'amount' => '0'
        ]);
        $this->insert('{{resource}}', [
            'resource_id' => '2',
            'resource_name' => 'Дерево',
            'needs_time' => '30',
            'amount' => '2'
        ]);
        $this->insert('{{resource}}', [
            'resource_id' => '3',
            'resource_name' => 'Камень',
            'needs_time' => '45',
            'amount' => '2'
        ]);
        $this->insert('{{resource}}', [
            'resource_id' => '4',
            'resource_name' => 'Шкуры животных',
            'needs_time' => '120',
            'amount' => '2'
        ]);
        $this->insert('{{resource}}', [
            'resource_id' => '5',
            'resource_name' => 'Рыба',
            'needs_time' => '140',
            'amount' => '8'
        ]);

        $this->addForeignKey('resource', 'user_resource', 'resource_id', 'resource', 'resource_id', 'cascade', 'cascade');
    }
    public function safeDown()
    {
//        $this->dropForeignKey('profile_user', 'profile');
//        $this->dropTable('profile');
    }

}