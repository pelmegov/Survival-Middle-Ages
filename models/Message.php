<?php
namespace app\models;
/**
* Created by PhpStorm.
* User: user2
 * Date: 08.08.2016
 * Time: 17:20
 */
class Message extends \bubasuma\simplechat\db\Message
{
    /**
     * @inheritDoc
     */
    public function fields()
    {
        return [
            //...
            'text',
            'date' => 'created_at',
            //...
        ];
    }
}