<?php

/**
 * Created by PhpStorm.
 * User: TheLetch
 * Date: 13/12/2016
 * Time: 17:27
 */

use Phalcon\Mvc\Model;

class Chat extends Model{

    private $chat_id;
    private $chat_name;


    public function initialize()
    {
        $this->belongsTo('chat_id','Establishment','chat_id');
        $this->belongsTo('chat_id','Event','chat_id');

    }


    /**
     * @return mixed
     */
    public function getChatId()
    {
        return $this->chat_id;
    }

    /**
     * @param mixed $chat_id
     */
//    public function setChatId($chat_id)
//    {
//        $this->chat_id = $chat_id;
//    }

    /**
     * @return mixed
     */
    public function getChatName()
    {
        return $this->chat_name;
    }

    /**
     * @param mixed $chat_name
     */
    public function setChatName($chat_name)
    {
        $this->chat_name = $chat_name;
    }



}