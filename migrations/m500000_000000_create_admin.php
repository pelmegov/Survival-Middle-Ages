<?php
/**
 * Created by PhpStorm.
 * User: user2
 * Date: 02.08.2016
 * Time: 10:32
 */
use yii\db\Migration;
class m500000_000000_create_admin extends Migration
{
    public function up()
    {
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

        $this->insert('{{profile}}', [
            'user_id' => '1',
            'nickname' => 'ADMIN'
        ]);

        $this->insert('{{user_resource}}', [
            'user_id' => '1',
            'resource_id' => '1',
            'amount' => '10000000',
            'time_start' => '0',
        ]);
        $this->insert('{{user_resource}}', [
            'user_id' => '1',
            'resource_id' => '2',
            'amount' => '100',
            'time_start' => '0',
        ]);
        $this->insert('{{user_resource}}', [
            'user_id' => '1',
            'resource_id' => '3',
            'amount' => '100',
            'time_start' => '0',
        ]);
        $this->insert('{{user_resource}}', [
            'user_id' => '1',
            'resource_id' => '4',
            'amount' => '100',
            'time_start' => '0',
        ]);
        $this->insert('{{user_resource}}', [
            'user_id' => '1',
            'resource_id' => '5',
            'amount' => '100',
            'time_start' => '0',
        ]);
    }
    public function down()
    {
//        $this->delete('{{user}}', 'username = "admin"');
//        $this->delete('{{profile}}', 'nickname = "ADMIN"');
    }
}