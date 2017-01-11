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
    /**
     *
     * @var string
     * @Column(type="string", length=70, nullable=false)
     */
    protected $name;
    protected $establishment_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $description;

    /**
     * Method to set the value of field establishment_id
     *
     * @param integer $establishment_id
     * @return $this
     */
    public function setEstablishmentId($establishment_id)
    {
        $this->establishment_id = $establishment_id;

    }

    /**
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
    public function setEstablishmentName($name)
    {
        $this->name = $name;
    }

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
        $this->setSchema("project_bd");
        $this->hasMany('establishment_id', 'Branch', 'establishment_id', ['alias' => 'Branch']);
        return $this;
    }

    /**
     * Method to set the value of field description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Returns the value of field establishment_id
     *
     * @return integer
     */
    public function getEstablishmentId()
    {
        return $this->establishment_id;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getEstablishmentName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }



    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'establishment';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Establishment[]|Establishment
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Establishment
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
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