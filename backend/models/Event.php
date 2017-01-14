<?php

/**
 * Created by PhpStorm.
 * User: TheLetch
 * Date: 13/12/2016
 * Time: 18:01
 */
use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Mvc\Model\Relation;
use Phalcon\Validation\Validator\Date as DateValidator;
//use Phalcon\Validation\Validator\Uniqueness as Unique;

class Event extends Model
{
    private $event_id;
    private $event_name;
    private $type;
    private $date;
    private $begin;
    private $end;
    private $chat_id;
    private $establishment_id;
    private $description;


    public function initialize()
    {
        $this->hasOne(
            'chat_id',
            'Chat',
            'chat_id',
            [
                'foreignKey'=>[
                    'action'=>Relation::ACTION_CASCADE,
                ]
            ]
        );

        $this->hasOne(
            'establishment_id',
            'EventOrganizator',
            'establishment_id'
        );

//        $this->belongsTo(
//            'establishment_id',
//            'Establis'
//        )

    }

    /**
     * @return mixed
     */
    public function getEventId()
    {
        return $this->event_id;
    }

    /**
     * @param mixed $event_id
     */
//    public function setEventId($event_id)
//    {
//        $this->event_id = $event_id;
//    }

    /**
     * @return mixed
     */
    public function getEventName()
    {
        return $this->event_name;
    }

    /**
     * @param mixed $event_name
     */
    public function setEventName($event_name)
    {
        if (strlen($event_name)<5 && strlen($event_name)>25){
            throw new InvalidArgumentException(
                 json_encode("Even too short or too long")
            );
        }
        $this->event_name = $event_name;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $eventDate = new DateTime($date);
        $currentDate = new DateTime('now');
        if ($currentDate<$eventDate){
            $this->date = $date;

        } else{
            json_encode('please select a latter date') ;
        }


    }

    /**
     * @return mixed
     */
    public function getBegin()
    {
        return $this->begin;
    }

    /**
     * @param mixed $begin
     */
    public function setBegin($begin)
    {
        $this->begin = $begin;
    }

    /**
     * @return mixed
     */
    public function getEnd()

    {
        return $this->end;
    }

    /**
     * @param mixed $end
     */
    public function setEnd($end)
    {

        $eventDate = $this->date;
        $separator= " ";

        $startTime = new DateTime($eventDate.$separator.$this->begin);
        $endTime = new DateTime($eventDate.$separator.$end);
        //TODO: compare the end and the begin time
        if ($endTime>$startTime){
            $this->end = $end;

        }else{
            return json_encode("The end time should be later than the beginning ");
        }


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
    public function setChatId($chat_id)
    {
        $this->chat_id = $chat_id;
    }

    /**
     * @return mixed
     */
    public function getEstablishmentId()
    {
        return $this->establishment_id;
    }

    /**
     * @param mixed $establishment_id
     */
    public function setEstablishmentId($establishment_id)
    {
        $this->establishment_id = $establishment_id;
    }




    public function validation(){
        $validator = new Validation();
        $validator->add(
            'date',
            new DateValidator(
                [
                    'format'=>'y-m-d',
                    'message'=>'Please check the date format',
                ]
            )
        );

        $validator->add(
            'event_name',
            new PresenceOf(
               [
                   'message'=> 'You should give a name to your event',
                   'cancelOnFail'=> true,
               ]
            )

        );

       //TODO: add a list of event type to the validator
    }


    public function getEventInfo($id){
        $data=[
          $this->getEventName(),
            $this->getBegin(),
            $this->getEnd(),
            $this->getDate(),
            $this->getType(),
            $this->getChatId(),


        ];

        return $data;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }






}