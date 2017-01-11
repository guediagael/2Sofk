<?php
use Phalcon\Validation;
use Phalcon\Validation\validator\Uniqueness as ValidatorUniqueness;
class Branch extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $establishment_id;

    /**
     *
     * @var string
     * @Primary
     * @Column(type="string", length=58, nullable=false)
     */
    protected $city;

    /**
     *
     * @var string
     * @Primary
     * @Column(type="string", length=50, nullable=false)
     */
    protected $district;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $description;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $longitude;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $latitude;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $rating;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $chat_id;

    /**
     * Method to set the value of field establishment_id
     *
     * @param integer $establishment_id
     * @return $this
     */
    public function setEstablishmentId($establishment_id)
    {
        $this->establishment_id = $establishment_id;

        return $this;
    }

    /**
     * Method to set the value of field city
     *
     * @param string $city
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Method to set the value of field district
     *
     * @param string $district
     * @return $this
     */
    public function setDistrict($district)
    {
        $this->district = $district;

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
     * Method to set the value of field longitude
     *
     * @param string $longitude
     * @return $this
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Method to set the value of field latitude
     *
     * @param string $latitude
     * @return $this
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Method to set the value of field rating
     *
     * @param string $rating
     * @return $this
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

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
     * Returns the value of field establishment_id
     *
     * @return integer
     */
    public function getEstablishmentId()
    {
        return $this->establishment_id;
    }

    /**
     * Returns the value of field city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Returns the value of field district
     *
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
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
     * Returns the value of field longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Returns the value of field latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Returns the value of field rating
     *
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Returns the value of field chat_id
     *
     * @return integer
=======

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Relation;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;


/**
 * Created by PhpStorm.
 * User: TheLetch
 * Date: 30/12/2016
 * Time: 13:37
 */
class Branch extends Model
{

    private $establishment_id;
    private $city;
    private $district;
    private $longitude;
    private $latitude;
    private $rating;
    private $description;
    private $chat_id;

    /**
     * @return mixed
     */

    public function initialize(){

        $this->belongsTo('establishment_id','Establishment','establishment_id',
            [
                'foreignKey'=> true
            ]);


        $this->hasOne(
            'chat_id',
            'Chat',
            'chat_id',
            [
                'foreignKey'=>[
                    'action'=>Relation::ACTION_CASCADE
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
     * @param mixed $establishment_id
     */
    public function setEstablishmentId($establishment_id)
    {
        $this->establishment_id = $establishment_id;
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
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
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
>>>>>>> 3afa0e71229b23762163eb911c1c2545849a920f
     */
    public function getChatId()
    {
        return $this->chat_id;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("project_bd");
        $this->belongsTo('establishment_id', '\Establishment', 'establishment_id', ['alias' => 'Establishment']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'branch';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Branch[]|Branch
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Branch
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     *
     */
     public function Validation()
     {
         $validator=new Validation();
         $validator->add(
             'establishment_id',
             new ValidatorUniqueness(
                 [
                     'model' => $this,
                     'message' => 'incorrect data'
                 ]
             )
         );
         return $this->validate($validator);
     }
}
=======
     * @param mixed $chat_id
     */
    public function setChatId($chat_id)
    {
        $this->chat_id = $chat_id;
    }




}
>>>>>>> 3afa0e71229b23762163eb911c1c2545849a920f
