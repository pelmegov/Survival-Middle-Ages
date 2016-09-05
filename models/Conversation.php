<?php
namespace app\models;

/**
 * Created by PhpStorm.
 * User: user2
 * Date: 08.08.2016
 * Time: 17:19
 */

class Conversation extends \bubasuma\simplechat\db\Conversation
{
    public function getContact()
    {
        return $this->hasOne(User::className(), ['id' => 'contact_id']);
    }

    /**
     * @inheritDoc
     */
    protected static function baseQuery($userId)
    {
        return parent::baseQuery($userId) ->with(['contact.profile']);
    }

    /**
     * @inheritDoc
     */
    public function fields()
    {
        return [
            //...
            'contact' => function ($model) {
                return $model['contact'];
            },
            'deleteUrl',
            'readUrl',
            'unreadUrl',
            //...
        ];
    }
}