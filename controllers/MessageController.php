<?php
/**
 * Created by PhpStorm.
 * User: user2
 * Date: 08.08.2016
 * Time: 17:20
 */
use yii\web\Controller;
use app\models\Conversation;
use app\models\Message;
use bubasuma\simplechat\controllers\ControllerTrait;

//...

class MessageController extends Controller
{
    use ControllerTrait;

    /**
     * @return string
     */
    public function getMessageClass()
    {
        return Message::className();
    }

    /**
     * @return string
     */
    public function getConversationClass()
    {
        return Conversation::className();
    }
}