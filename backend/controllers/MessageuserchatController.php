<?php

use Phalcon\Mvc\Micro;
use Phalcon\Http\Response;
use Phalcon\DI;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Model\Resultset;
use Phalcon\Mvc\Model\Query;
class MessageUserChatController extends ControllerBase
{

    public function indexAction()
    {

    }

    /**
     * @param $sender
     * @param $chat
     * @param $msg
     */
    public function addMessageUserAction($sender,$chat,$msg)
    {
        echo "adding new message";
        $msgUser=new MessageChatUser();
        $msgUser->setChatId($chat);
        $msgUser->setSenderId($sender);
        $msgUser->setMsgId($msg);
        $test=$msgUser->save();
         if ($test==false)
         {
             $res=$msgUser->getMessages();
             foreach ($res as $m)
             {
                 echo "Message:",$m->getMessage();
                 echo "Message: ",$m->getField();
                 echo "Message: ",$m->getType();
             }
         }

    }

    /**
     * @return mixed
     */
    public function getMessageAction($id)
    {
        $result=MessageChatUser::find($id);
        return $this->extractData($result);

    }

}

