<?php

class UserEvent extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $id_user;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $id_event;

    /**
     * Method to set the value of field id_user
     *
     * @param integer $id_user
     * @return $this
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * Method to set the value of field id_event
     *
     * @param integer $id_event
     * @return $this
     */
    public function setIdEvent($id_event)
    {
        $this->id_event = $id_event;

        return $this;
    }

    /**
     * Returns the value of field id_user
     *
     * @return integer
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * Returns the value of field id_event
     *
     * @return integer
     */
    public function getIdEvent()
    {
        return $this->id_event;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("project_bd");
        $this->belongsTo('id_user', '\User', 'user_id', ['alias' => 'User']);
        $this->belongsTo('id_event', '\Event', 'event_id', ['alias' => 'Event']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'user_event';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return UserEvent[]|UserEvent
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return UserEvent
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
