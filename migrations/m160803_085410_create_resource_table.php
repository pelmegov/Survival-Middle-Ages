<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `resource`.
 */
class m160803_085410_create_resource_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('resource', [
            'resource_id' => Schema::TYPE_PK,
            'resource_name' => Schema::TYPE_STRING,
            'needs_time' => Schema::TYPE_INTEGER,
            'amount' => Schema::TYPE_INTEGER,
            'link_bg_image' => Schema::TYPE_STRING,
        ]);

        $this->insert('{{resource}}', [
            'resource_id' => '1',
            'resource_name' => 'Золото',
            'needs_time' => '0',
            'amount' => '0',
            'link_bg_image' => 'images/default_bg.jpg'
        ]);
        $this->insert('{{resource}}', [
            'resource_id' => '2',
            'resource_name' => 'Дерево',
            'needs_time' => '30',
            'amount' => '2',
            'link_bg_image' => 'images/default_bg.jpg'
        ]);
        $this->insert('{{resource}}', [
            'resource_id' => '3',
            'resource_name' => 'Камень',
            'needs_time' => '45',
            'amount' => '2',
            'link_bg_image' => 'images/default_bg.jpg'
        ]);
        $this->insert('{{resource}}', [
            'resource_id' => '4',
            'resource_name' => 'Шкуры животных',
            'needs_time' => '120',
            'amount' => '2',
            'link_bg_image' => 'images/default_bg.jpg'
        ]);
        $this->insert('{{resource}}', [
            'resource_id' => '5',
            'resource_name' => 'Рыба',
            'needs_time' => '140',
            'amount' => '8',
            'link_bg_image' => 'images/fishing.jpg'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('resource');
    }
}
