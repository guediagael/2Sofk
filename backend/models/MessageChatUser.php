<?php
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
class MessageChatUser extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $sender_id;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $chat_id;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $msg_id;

    /**
     * Method to set the value of field sender_id
     *
     * @param integer $sender_id
     * @return $this
     */
    public function setSenderId($sender_id)
    {
        $this->sender_id = $sender_id;

        return $this;
    }

    /**
     * Method to set the value of field chat_id
     *
     * @param integer $chat_id
     * @return $this
     */
    public function setChatId($chat_id)
    {
        $this->chat_id = $chat_id;

        return $this;
    }

    /**
     * Method to set the value of field msg_id
     *
     * @param integer $msg_id
     * @return $this
     */
    public function setMsgId($msg_id)
    {
        $this->msg_id = $msg_id;

        return $this;
    }

    /**
     * Returns the value of field sender_id
     *
     * @return integer
     */
    public function getSenderId()
    {
        return $this->sender_id;
    }

    /**
     * Returns the value of field chat_id
     *
     * @return integer
     */
    public function getChatId()
    {
        return $this->chat_id;
    }

    /**
     * Returns the value of field msg_id
     *
     * @return integer
     */
    public function getMsgId()
    {
        return $this->msg_id;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("project_bd");
        $this->belongsTo('sender_id', '\User', 'user_id', ['alias' => 'User']);
        $this->belongsTo('chat_id', '\Chat', 'chat_id', ['alias' => 'Chat']);
        $this->belongsTo('msg_id', '\Message', 'message_id', ['alias' => 'Message']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'message_chat_user';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MessageChatUser[]|MessageChatUser
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MessageChatUser
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
   public function validation()
   {
     //$validator = new Validation();

   }
}
