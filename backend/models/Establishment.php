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
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Mvc\Model\Relation;

class Establishment extends Model
{

    private $establishment_id;
    private $establishment_name;
//    private $rating;
//    private $city;
//    private $district;
    private $description;
//    private $address;
//    private $chat_id;




    public function initialize(){


        $this->hasMany(
            'establishment_id',
            'Branch',
            'establishment_id',
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



    public function validation(){
        $validator= new Validation();
        $validator->add(
            'establishment_name',
                new UniquenessValidator(
                [
                    'model'=>$this,
                    'message'=>':field must be unique',
                ]
            )
        );

        $validator->add(
            'establishment_name',
            new presenceOf(
        [
            'message'=>':field can\'t be empty',
            'cancelOnFail'=> true,
        ]

        )
        );


        return $this->validate($validator);

    }

}