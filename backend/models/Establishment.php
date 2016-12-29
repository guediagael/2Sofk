<?php

/**
 * Created by PhpStorm.
 * User: TheLetch
 * Date: 13/12/2016
 * Time: 17:56
 */
use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;

class Establishment extends Model
{

    private $establishment_id;
    private $establishment_name;
    private $rating;
    private $city;
    private $district;
    private $description;
    private $address;
    private $chat_id;




    public function initialize(){
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

    }

    /**
     * @return mixed
     */
    public function getEstablishmentId()
    {
        return $this->establishment_id;
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
    public function getEstablishmentName()
    {
        return $this->establishment_name;
    }

    /**
     * @param mixed $establishment_name
     */
    public function setEstablishmentName($establishment_name)
    {
        $this->establishment_name = $establishment_name;
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

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @param mixed $district
     */
    public function setDistrict($district)
    {
        $this->district = $district;
    }




    /**
     * @param mixed $chat_id
     */
    public function setChatId($chat_id)
    {
        $this->chat_id = $chat_id;
    }

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