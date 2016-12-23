<?php

/**
 * Created by PhpStorm.
 * User: TheLetch
 * Date: 13/12/2016
 * Time: 17:56
 */
use Phalcon\Mvc\Model;
use Phalcon\Validation;

class Institution extends Model
{

    private $chat_id;
    private $institution_id;
    private $name;
    private $rating;




    /**
     * @return mixed
     */
    public function getInstitutionId()
    {
        return $this->institution_id;
    }

    /**
     * @param mixed $institution_id
     */
//    public function setInstitutionId($institution_id)
//    {
//        $this->institution_id = $institution_id;
//    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
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

    public function validation(){
        $validator= new Validation();
        $validator->add(
            'name',
            new presenceOf(
        [
            'message'=>'The field name can\'t be empty',
            'cancelOnFail'=> true,
        ]

        )
        );


    }

}