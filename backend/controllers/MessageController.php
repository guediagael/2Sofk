<?php
use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\DI;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Model\Resultset;
use Phalcon\Mvc\Model\Query;
/**
 * Created by PhpStorm.
 * User: TheLetch
 * Date: 14/12/2016
 * Time: 14:17
 */
class MessageController extends ControllerBase
{
    /*
       * list conversation  in the chat
       */
    public function searchSenderAction($id_chat)
    {
        $psql=" select DISTINCT U.nickname,Msg.message_text, Msg.date 
              from  
                User U JOIN MessageChatUser M   
                       JOIN Message Msg
                      JOIN Chat C
              WHERE  
                U.user_id=M.sender_id and M.chat_id=C.chat_id and M.msg_id=Msg.message_id and C.chat_id=$id_chat
               ORDER by Msg.date";

        $result= $this->modelsManager->executeQuery($psql);
        return $this->extractData($result);
    }


}